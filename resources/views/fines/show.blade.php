@extends('layouts.app')

@section('title', 'Fine Details')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-circle-exclamation" style="color: #ff3b30;"></i>
            Fine Details
        </h2>
        <div style="display: flex; gap: 1rem;">
            @if($fine->status == 'pending')
                <button onclick="document.getElementById('pay-form').style.display='block'" class="btn btn-success">
                    <i class="fa-regular fa-credit-card"></i>
                    Make Payment
                </button>
            @endif
            <a href="{{ route('fines.index') }}" class="btn">
                <i class="fa-regular fa-arrow-left"></i>
                Back
            </a>
        </div>
    </div>

    @if($fine->status == 'pending')
        <form id="pay-form" action="{{ route('fines.pay', $fine) }}" method="POST" style="display: none; margin-bottom: 1.5rem;">
            @csrf
            <div style="background: #f8f8fa; padding: 1rem; border-radius: 12px; display: flex; gap: 1rem; align-items: center;">
                <div style="flex: 1;">
                    <label class="form-label">Payment Amount</label>
                    <input type="number" name="amount" class="form-control" placeholder="Enter amount" step="0.01" max="{{ $fine->remaining_amount }}" min="0.01" required>
                </div>
                <button type="submit" class="btn btn-success">Process Payment</button>
                <button type="button" onclick="document.getElementById('pay-form').style.display='none'" class="btn">Cancel</button>
            </div>
        </form>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <!-- Fine Information -->
        <div>
            <h3 style="margin-bottom: 1rem;">Fine Information</h3>
            <div style="background: #f8f8fa; border-radius: 16px; padding: 1.5rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: #6e6e73;">Fine Amount</span>
                    <span style="font-weight: 700; font-size: 1.25rem;"><span class="pesos">{{ number_format($fine->amount, 2) }}</span></span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: #6e6e73;">Paid Amount</span>
                    <span style="font-weight: 600;"><span class="pesos">{{ number_format($fine->paid_amount, 2) }}</span></span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: #6e6e73;">Remaining Balance</span>
                    <span style="font-weight: 600; color: {{ $fine->remaining_amount > 0 ? '#ff3b30' : '#34c759' }};">
                        <span class="pesos">{{ number_format($fine->remaining_amount, 2) }}</span>
                    </span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: #6e6e73;">Status</span>
                    @if($fine->status == 'pending')
                        <span class="badge badge-warning">
                            <i class="fa-regular fa-clock"></i> Pending
                        </span>
                    @else
                        <span class="badge badge-success">
                            <i class="fa-regular fa-circle-check"></i> Paid
                        </span>
                    @endif
                </div>
                @if($fine->reason)
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e8e8ed;">
                        <span style="color: #6e6e73;">Reason</span>
                        <p style="margin-top: 0.5rem;">{{ $fine->reason }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Loan Information -->
        <div>
            <h3 style="margin-bottom: 1rem;">Related Loan</h3>
            <div style="background: #f8f8fa; border-radius: 16px; padding: 1.5rem;">
                <div style="margin-bottom: 1rem;">
                    <span style="color: #6e6e73;">Loan Number</span>
                    <div style="font-weight: 600; font-family: monospace; margin-top: 0.25rem;">{{ $fine->loan->loan_number }}</div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <span style="color: #6e6e73;">Book</span>
                    <div style="font-weight: 600; margin-top: 0.25rem;">{{ $fine->loan->book->title }}</div>
                    <div style="font-size: 0.9rem; color: #6e6e73;">by {{ $fine->loan->book->author }}</div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <span style="color: #6e6e73;">Member</span>
                    <div style="font-weight: 600; margin-top: 0.25rem;">{{ $fine->loan->member->name }}</div>
                    <div style="font-size: 0.9rem; color: #6e6e73;">{{ $fine->loan->member->email }}</div>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                    <a href="{{ route('loans.show', $fine->loan) }}" class="btn btn-primary" style="flex: 1;">
                        <i class="fa-regular fa-eye"></i>
                        View Loan
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if($fine->status == 'pending')
        <div style="margin-top: 1.5rem; background: #fff4e5; border-radius: 16px; padding: 1.5rem;">
            <h4 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; color: #b06400;">
                <i class="fa-regular fa-circle-info"></i>
                Payment Information
            </h4>
            <p style="color: #6e6e73;">Please settle the remaining balance of <span class="pesos" style="font-weight: 600;">{{ number_format($fine->remaining_amount, 2) }}</span> to clear this fine. Payments can be made at the library counter or through online payment.</p>
        </div>
    @endif
</div>
@endsection
