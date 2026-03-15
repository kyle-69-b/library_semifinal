<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use App\Models\Fine;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function generateBookReport(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $books = Book::with('category')
            ->when($request->category_id, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->orderBy('title')
            ->get();

        $data = [
            'title' => 'Book Inventory Report',
            'date' => Carbon::now()->format('F j, Y'),
            'books' => $books,
            'totalBooks' => $books->count(),
            'totalAvailable' => $books->sum('available_quantity'),
            'totalBorrowed' => $books->sum('quantity') - $books->sum('available_quantity'),
        ];

        return Pdf::view('reports.pdf.book-report', $data)
            ->driver('dompdf') // Explicitly use dompdf
            ->format('a4')
            ->name('book-report-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    public function generateLoanReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $loans = Loan::with(['book', 'member'])
            ->whereBetween('loan_date', [$request->start_date, $request->end_date])
            ->orderBy('loan_date')
            ->get();

        $data = [
            'title' => 'Loan Activity Report',
            'date' => Carbon::now()->format('F j, Y'),
            'start_date' => Carbon::parse($request->start_date)->format('F j, Y'),
            'end_date' => Carbon::parse($request->end_date)->format('F j, Y'),
            'loans' => $loans,
            'totalLoans' => $loans->count(),
            'activeLoans' => $loans->where('status', 'active')->count(),
            'returnedLoans' => $loans->where('status', 'returned')->count(),
            'overdueLoans' => $loans->where('status', 'overdue')->count(),
        ];

        return Pdf::view('reports.pdf.loan-report', $data)
            ->driver('dompdf')
            ->format('a4')
            ->name('loan-report-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    public function generateMemberReport(Request $request)
    {
        $members = Member::withCount(['loans'])
            ->with(['loans' => function ($query) {
                $query->latest()->take(5);
            }])
            ->orderBy('name')
            ->get();

        $data = [
            'title' => 'Member Statistics Report',
            'date' => Carbon::now()->format('F j, Y'),
            'members' => $members,
            'totalMembers' => $members->count(),
            'activeMembers' => $members->where('status', 'active')->count(),
        ];

        return Pdf::view('reports.pdf.member-report', $data)
            ->driver('dompdf')
            ->format('a4')
            ->name('member-report-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    public function generateFineReport(Request $request)
    {
        $fines = Fine::with(['loan.book', 'loan.member'])
            ->whereBetween('created_at', [
                $request->start_date ?? Carbon::now()->startOfMonth(),
                $request->end_date ?? Carbon::now()->endOfMonth()
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        $data = [
            'title' => 'Fines Collection Report',
            'date' => Carbon::now()->format('F j, Y'),
            'fines' => $fines,
            'totalFines' => $fines->sum('amount'),
            'totalPaid' => $fines->sum('paid_amount'),
            'totalPending' => $fines->sum('amount') - $fines->sum('paid_amount'),
        ];

        return Pdf::view('reports.pdf.fine-report', $data)
            ->driver('dompdf')
            ->format('a4')
            ->name('fine-report-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }
}
