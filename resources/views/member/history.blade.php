{{-- resources/views/member/history.blade.php --}}
@extends('layouts.member')

@section('title', 'Borrowing History')
@section('page-title', 'Borrowing History')

@section('content')
<div class="card">
    @if($history->isEmpty())
    <div style="text-align:center; padding:60px 0;">
        <div style="font-size:48px; margin-bottom:16px;">📖</div>
        <div style="font-size:16px; color:var(--text2);">No borrowing history yet.</div>
    </div>
    @else
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Loan #</th>
                    <th>Book Title</th>
                    <th>Borrowed</th>
                    <th>Due Date</th>
                    <th>Returned</th>
                </tr>
            </thead>
            <tbody>
            @foreach($history as $loan)
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
                <td style="font-size:12px; color:var(--text2);">
                    {{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}
                </td>
                <td style="font-size:12px; color:var(--success);">
                    {{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('M d, Y') : '—' }}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{ $history->links('vendor.pagination.simple-default') }}
    </div>
    @endif
</div>
@endsection
