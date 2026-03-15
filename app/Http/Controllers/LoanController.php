<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with(['book', 'member']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->member_id) {
            $query->where('member_id', $request->member_id);
        }

        $loans = $query->orderBy('created_at', 'desc')->paginate(10);
        $members = Member::where('status', 'active')->get();

        return view('loans.index', compact('loans', 'members'));
    }

    public function create()
    {
        $books = Book::where('available_quantity', '>', 0)->get();
        $members = Member::where('status', 'active')->get();

        return view('loans.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after:loan_date',
            'notes' => 'nullable',
        ]);

        // Check if member has overdue books
        $member = Member::find($validated['member_id']);
        if ($member->activeLoans()->where('status', 'overdue')->count() > 0) {
            return back()->with('error', 'Member has overdue books. Cannot issue new loan.');
        }

        // Check if member has unpaid fines
        if ($member->totalFines() > 0) {
            return back()->with('error', 'Member has unpaid fines. Cannot issue new loan.');
        }

        $validated['loan_number'] = 'LN-' . strtoupper(Str::random(8));
        $validated['status'] = 'active';

        Loan::create($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Loan created successfully.');
    }

    public function show(Loan $loan)
    {
        $loan->load(['book', 'member', 'fine']);
        return view('loans.show', compact('loan'));
    }

    public function returnBook(Request $request, Loan $loan)
    {
        $request->validate([
            'return_date' => 'required|date',
        ]);

        $loan->return_date = $request->return_date;
        $loan->status = 'returned';
        $loan->save();

        return redirect()->route('loans.show', $loan)
            ->with('success', 'Book returned successfully.');
    }

    public function markOverdue(Loan $loan)
    {
        if ($loan->status == 'active' && $loan->due_date < now()) {
            $loan->status = 'overdue';
            $loan->save();

            // Queue overdue email
            \Mail::to($loan->member->email)->queue(new \App\Mail\OverdueReminderMail($loan));
        }

        return back()->with('success', 'Loan marked as overdue.');
    }
}
