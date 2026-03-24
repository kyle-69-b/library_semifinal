{{-- resources/views/member/loans.blade.php --}}
@extends('layouts.member')

@section('title', 'My Loans')
@section('page-title', 'My Active Loans')

@section('content')
<div class="card">
    @if($loans->isEmpty())
    <div style="text-align:center; padding:60px 0;">
        <div style="font-size:48px; margin-bottom:16px;">📚</div>
        <div style="font-size:16px; color:var(--text2);">You have no active loans.</div>
    </div>
    @else
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Loan #</th>
                    <th>Book Title</th>
                    <th>Loan Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($loans as $loan)
            <tr>
                <td style="font-family:monospace; font-size:12px; color:var(--teal2);">
                    {{ $loan->loan_number }}
                </td>
                <td>
                    <strong>{{ $loan->book->title ?? 'Unknown Book' }}</strong>
                    <div style="font-size:11px; color:var(--text2);">{{ $loan->book->author ?? '' }}</div>
                </td>
                <td style="font-size:12px; color:var(--text2);">
                    {{ \Carbon\Carbon::parse($loan->loan_date)->format('M d, Y') }}
                </td>
                <td style="font-size:12px;">
                    <span style="color: {{ \Carbon\Carbon::parse($loan->due_date)->isPast() ? 'var(--danger)' : 'var(--text)' }}">
                        {{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}
                    </span>
                </td>
                <td>
                    @if($loan->status === 'overdue')
                        <span class="badge badge-danger">Overdue</span>
                    @elseif(\Carbon\Carbon::parse($loan->due_date)->diffInDays(now()) <= 3 && !(\Carbon\Carbon::parse($loan->due_date)->isPast()))
                        <span class="badge badge-warning">Due Soon</span>
                    @else
                        <span class="badge badge-info">Borrowed</span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
