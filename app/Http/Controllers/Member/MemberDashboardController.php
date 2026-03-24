<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use Illuminate\Support\Facades\Auth;

class MemberDashboardController extends Controller
{
    private function member()
    {
        return Auth::guard('member')->user();
    }

    public function index()
    {
        $member = $this->member();

        // Active loans — status = 'borrowed'
        $activeLoans = $member->loans()
            ->with('book')
            ->where('status', 'borrowed')
            ->orderBy('due_date')
            ->get();

        // Overdue loans — status = 'overdue'
        $overdueLoans = $member->loans()
            ->with('book')
            ->where('status', 'overdue')
            ->orderBy('due_date')
            ->get();

        // Total unpaid fines — through loan_id (no member_id on fines table)
        $loanIds    = $member->loans()->pluck('id');
        $totalFines = Fine::whereIn('loan_id', $loanIds)
            ->where('status', 'unpaid')
            ->sum('amount');

        // Recent returned books — uses 'return_date' (your actual column)
        $recentHistory = $member->loans()
            ->with('book')
            ->where('status', 'returned')
            ->orderBy('return_date', 'desc')
            ->limit(5)
            ->get();

        return view('member.dashboard', compact(
            'member', 'activeLoans', 'overdueLoans', 'totalFines', 'recentHistory'
        ));
    }

    public function loans()
    {
        $member = $this->member();
        $loans  = $member->loans()
            ->with('book')
            ->whereIn('status', ['borrowed', 'overdue'])
            ->orderBy('due_date')
            ->get();
        return view('member.loans', compact('member', 'loans'));
    }

    public function history()
    {
        $member  = $this->member();
        $history = $member->loans()
            ->with('book')
            ->where('status', 'returned')
            ->orderBy('return_date', 'desc')
            ->paginate(15);
        return view('member.history', compact('member', 'history'));
    }

    public function fines()
    {
        $member  = $this->member();
        $loanIds = $member->loans()->pluck('id');
        $fines   = Fine::whereIn('loan_id', $loanIds)
            ->with('loan.book')
            ->latest()
            ->paginate(15);
        return view('member.fines', compact('member', 'fines'));
    }
}
