{{-- resources/views/member/dashboard.blade.php --}}
@extends('layouts.member')

@section('title', 'My Dashboard')
@section('page-title', 'My Dashboard')

@section('content')

{{-- Stats --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-book-open"></i></div>
        <div class="stat-value">{{ $activeLoans->count() }}</div>
        <div class="stat-label">Active Loans</div>
    </div>
    <div class="stat-card danger">
        <div class="stat-icon"><i class="fas fa-triangle-exclamation"></i></div>
        <div class="stat-value">{{ $overdueLoans->count() }}</div>
        <div class="stat-label">Overdue Books</div>
    </div>
    <div class="stat-card warning">
        <div class="stat-icon"><i class="fas fa-peso-sign"></i></div>
        <div class="stat-value">₱{{ number_format($totalFines, 2) }}</div>
        <div class="stat-label">Outstanding Fines</div>
    </div>
    <div class="stat-card success">
        <div class="stat-icon"><i class="fas fa-clock-rotate-left"></i></div>
        <div class="stat-value">{{ $recentHistory->count() }}</div>
        <div class="stat-label">Books Returned</div>
    </div>
</div>

<div class="grid-2">

    {{-- Active Loans --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Active Loans</div>
            <a href="{{ route('member.loans') }}" class="btn btn-secondary btn-sm">View All</a>
        </div>
        @forelse($activeLoans as $loan)
        <div style="padding:12px 0; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:14px;">
            <div style="width:38px;height:38px;background:rgba(42,157,143,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--teal);font-size:14px;flex-shrink:0;">
                <i class="fas fa-book"></i>
            </div>
            <div style="flex:1; min-width:0;">
                <div style="font-size:13px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $loan->book->title }}</div>
                <div style="font-size:11px;color:var(--text2);margin-top:2px;">Due: {{ $loan->due_date->format('M d, Y') }}</div>
            </div>
            @if($loan->due_date->isPast())
                <span class="badge badge-danger">Overdue</span>
            @elseif($loan->due_date->diffInDays(now()) <= 3)
                <span class="badge badge-warning">Due Soon</span>
            @else
                <span class="badge badge-success">On Time</span>
            @endif
        </div>
        @empty
        <p style="color:var(--text2);font-size:13px;padding:12px 0;">No active loans. Visit the library to borrow a book!</p>
        @endforelse
    </div>

    {{-- Recent History --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Recent Returns</div>
            <a href="{{ route('member.history') }}" class="btn btn-secondary btn-sm">Full History</a>
        </div>
        @forelse($recentHistory as $loan)
        <div style="padding:12px 0; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:14px;">
            <div style="width:38px;height:38px;background:rgba(92,184,92,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--success);font-size:14px;flex-shrink:0;">
                <i class="fas fa-check"></i>
            </div>
            <div style="flex:1; min-width:0;">
                <div style="font-size:13px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $loan->book->title }}</div>
                <div style="font-size:11px;color:var(--text2);margin-top:2px;">Returned: {{ $loan->returned_date?->format('M d, Y') ?? '—' }}</div>
            </div>
            @if($loan->fine_amount > 0)
                <span style="font-size:12px;color:var(--danger);">₱{{ number_format($loan->fine_amount,2) }}</span>
            @endif
        </div>
        @empty
        <p style="color:var(--text2);font-size:13px;padding:12px 0;">No borrowing history yet.</p>
        @endforelse
    </div>

</div>

{{-- Overdue warning --}}
@if($overdueLoans->count() > 0)
<div style="margin-top:20px;" class="card">
    <div class="card-header">
        <div class="card-title" style="color:var(--danger);"><i class="fas fa-triangle-exclamation"></i> Overdue Books</div>
    </div>
    <div class="table-wrapper">
        <table>
            <thead><tr><th>Book</th><th>Due Date</th><th>Days Late</th><th>Estimated Fine</th></tr></thead>
            <tbody>
            @foreach($overdueLoans as $loan)
            <tr>
                <td><strong>{{ $loan->book->title }}</strong></td>
                <td><span class="badge badge-danger">{{ $loan->due_date->format('M d, Y') }}</span></td>
                <td style="color:var(--danger);font-weight:600;">{{ $loan->due_date->diffInDays(now()) }} days</td>
                <td style="color:var(--danger);">₱{{ number_format($loan->due_date->diffInDays(now()) * 5, 2) }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
