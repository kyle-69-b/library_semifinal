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
        <div class="stat-label">Recently Returned</div>
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
                <div style="font-size:13px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    {{ $loan->book->title ?? 'Unknown Book' }}
                </div>
                <div style="font-size:11px;color:var(--text2);margin-top:2px;">
                    Due: {{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}
                </div>
            </div>
            @if(\Carbon\Carbon::parse($loan->due_date)->isPast())
                <span class="badge badge-danger">Overdue</span>
            @elseif(\Carbon\Carbon::parse($loan->due_date)->diffInDays(now()) <= 3)
                <span class="badge badge-warning">Due Soon</span>
            @else
                <span class="badge badge-info">On Time</span>
            @endif
        </div>
        @empty
        <div style="padding:20px 0; text-align:center;">
            <div style="font-size:32px; margin-bottom:10px;">📚</div>
            <div style="font-size:13px; color:var(--text2);">No active loans.</div>
        </div>
        @endforelse
    </div>

    {{-- Recent Returns --}}
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
                <div style="font-size:13px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    {{ $loan->book->title ?? 'Unknown Book' }}
                </div>
                <div style="font-size:11px;color:var(--text2);margin-top:2px;">
                    Returned: {{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('M d, Y') : '—' }}
                </div>
            </div>
        </div>
        @empty
        <div style="padding:20px 0; text-align:center;">
            <div style="font-size:32px; margin-bottom:10px;">📖</div>
            <div style="font-size:13px; color:var(--text2);">No borrowing history yet.</div>
        </div>
        @endforelse
    </div>

</div>

{{-- Overdue Warning --}}
@if($overdueLoans->count() > 0)
<div class="card" style="margin-top:20px; border-color:rgba(217,83,79,0.3);">
    <div class="card-header">
        <div class="card-title" style="color:var(--danger);">
            <i class="fas fa-triangle-exclamation"></i> Overdue Books
        </div>
        <a href="{{ route('member.fines') }}" class="btn btn-secondary btn-sm">View Fines</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Due Date</th>
                    <th>Days Overdue</th>
                    <th>Est. Fine</th>
                </tr>
            </thead>
            <tbody>
            @foreach($overdueLoans as $loan)
            <tr>
                <td><strong>{{ $loan->book->title ?? 'Unknown Book' }}</strong></td>
                <td><span class="badge badge-danger">{{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}</span></td>
                <td style="color:var(--danger); font-weight:600;">
                    {{ \Carbon\Carbon::parse($loan->due_date)->diffInDays(now()) }} days
                </td>
                <td style="color:var(--danger);">
                    ₱{{ number_format(\Carbon\Carbon::parse($loan->due_date)->diffInDays(now()) * 5, 2) }}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
