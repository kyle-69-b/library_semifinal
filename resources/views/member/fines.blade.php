{{-- resources/views/member/fines.blade.php --}}
@extends('layouts.member')

@section('title', 'My Fines')
@section('page-title', 'My Fines')

@section('content')
<div class="card">
    @if($fines->isEmpty())
    <div style="text-align:center; padding:60px 0;">
        <div style="font-size:48px; margin-bottom:16px;">🎉</div>
        <div style="font-size:16px; color:var(--text2);">No fines on record. Keep it up!</div>
    </div>
    @else
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Reason</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach($fines as $fine)
            <tr>
                <td>
                    <strong>{{ $fine->loan->book->title ?? 'Unknown Book' }}</strong>
                </td>
                <td style="color:var(--text2); font-size:12px;">
                    {{ $fine->reason ?? '—' }}
                </td>
                <td style="color:var(--danger); font-weight:600;">
                    ₱{{ number_format($fine->amount, 2) }}
                </td>
                <td style="color:var(--success);">
                    ₱{{ number_format($fine->paid_amount, 2) }}
                </td>
                <td>
                    @if($fine->status === 'paid')
                        <span class="badge badge-success">Paid</span>
                    @elseif($fine->status === 'partial')
                        <span class="badge badge-warning">Partial</span>
                    @else
                        <span class="badge badge-danger">Unpaid</span>
                    @endif
                </td>
                <td style="font-size:12px; color:var(--text2);">
                    {{ \Carbon\Carbon::parse($fine->created_at)->format('M d, Y') }}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{ $fines->links('vendor.pagination.simple-default') }}
    </div>
    @endif
</div>
@endsection
