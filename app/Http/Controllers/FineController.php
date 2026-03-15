<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function index(Request $request)
    {
        $query = Fine::with(['loan.book', 'loan.member']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $fines = $query->orderBy('created_at', 'desc')->paginate(10);

        $totalPending = Fine::where('status', 'pending')->sum('amount');
        $totalPaid = Fine::where('status', 'paid')->sum('paid_amount');
        $totalCollected = Fine::sum('paid_amount');

        return view('fines.index', compact('fines', 'totalPending', 'totalPaid', 'totalCollected'));
    }

    public function show(Fine $fine)
    {
        $fine->load(['loan.book', 'loan.member']);
        return view('fines.show', compact('fine'));
    }

    public function pay(Request $request, Fine $fine)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01|max:' . ($fine->amount - $fine->paid_amount),
        ]);

        $fine->paid_amount += $request->amount;

        if ($fine->paid_amount >= $fine->amount) {
            $fine->status = 'paid';
        }

        $fine->save();

        return redirect()->route('fines.show', $fine)
            ->with('success', 'Payment of ₱' . number_format($request->amount, 2) . ' recorded successfully.');
    }
}
