@extends('layouts.app')

@section('title', 'Loan Details')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-hand-holding-hand" style="color: #ff9f0a;"></i>
            Loan Details: {{ $loan->loan_number }}
        </h2>
        <div style="display: flex; gap: 1rem;">
            @if($loan->status != 'returned')
                <button onclick="document.getElementById('return-form').style.display='block'" class="btn btn-success">
                    <i class="fa-regular fa-rotate-right"></i>
                    Return Book
                </button>
            @endif
            <a href="{{ route('loans.index') }}" class="btn">
                <i class="fa-regular fa-arrow-left"></i>
                Back
            </a>
        </div>
    </div>

    @if($loan->status != 'returned')
        <form id="return-form" action="{{ route('loans.return', $loan) }}" method="POST" style="display: none; margin-bottom: 1.5rem;">
            @csrf
            <div style="background: #f8f8fa; padding: 1rem; border-radius: 12px; display: flex; gap: 1rem; align-items: center;">
                <input type="date" name="return_date" class="form-control" value="{{ date('Y-m-d') }}" required style="width: 200px;">
                <button type="submit" class="btn btn-success">Confirm Return</button>
                <button type="button" onclick="document.getElementById('return-form').style.display='none'" class="btn">Cancel</button>
            </div>
        </form>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <!-- Loan Information -->
        <div>
            <h3 style="margin-bottom: 1rem;">Loan Information</h3>
            <div style="background: #f8f8fa; border-radius: 16px; padding: 1.5rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: #6e6e73;">Loan Number</span>
                    <span style="font-weight: 600; font-family: monospace;">{{ $loan->loan_number }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: #6e6e73;">Status</span>
                    @if($loan->status == 'active')
                        <span class="badge badge-success">
                            <i class="fa-regular fa-circle-check"></i> Active
                        </span>
                    @elseif($loan->status == 'overdue')
                        <span class="badge badge-danger">
                            <i class="fa-regular fa-circle-exclamation"></i> Overdue
                        </span>
                    @else
                        <span class="badge badge-info">
                            <i class="fa-regular fa-rotate-left"></i> Returned
                        </span>
                    @endif
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: #6e6e73;">Loan Date</span>
                    <span style="font-weight: 500;">{{ $loan->loan_date->format('F d, Y') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: #6e6e73;">Due Date</span>
                    <span style="font-weight: 500;">{{ $loan->due_date->format('F d, Y') }}</span>
                </div>
                @if($loan->return_date)
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                        <span style="color: #6e6e73;">Return Date</span>
                        <span style="font-weight: 500;">{{ $loan->return_date->format('F d, Y') }}</span>
                    </div>
                @endif
                @if($loan->notes)
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e8e8ed;">
                        <span style="color: #6e6e73;">Notes</span>
                        <p style="margin-top: 0.5rem;">{{ $loan->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Book and Member Information -->
        <div>
            <h3 style="margin-bottom: 1rem;">Book & Member</h3>
            <div style="background: #f8f8fa; border-radius: 16px; padding: 1.5rem;">
                <div style="margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #0071e3, #0051b3); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                            <i class="fa-regular fa-book-open"></i>
                        </div>
                        <div>
                            <div style="font-weight: 600;">{{ $loan->book->title }}</div>
                            <div style="font-size: 0.9rem; color: #6e6e73;">by {{ $loan->book->author }}</div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <span class="badge badge-info">ISBN: {{ $loan->book->isbn }}</span>
                        <span class="badge badge-info">{{ $loan->book->category->name }}</span>
                    </div>
                </div>

                <div style="border-top: 1px solid #e8e8ed; padding-top: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #34c759, #248a3d); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <div>
                            <div style="font-weight: 600;">{{ $loan->member->name }}</div>
                            <div style="font-size: 0.9rem; color: #6e6e73;">{{ $loan->member->email }}</div>
                        </div>
                    </div>
                    <div style="margin-top: 0.5rem;">
                        <span class="badge badge-info">{{ $loan->member->member_id }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($loan->fine)
        <div style="margin-top: 1.5rem;">
            <h3 style="margin-bottom: 1rem;">Associated Fine</h3>
            <div style="background: {{ $loan->fine->status == 'pending' ? '#ffe9e9' : '#e5f5e9' }}; border-radius: 16px; padding: 1.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div style="font-weight: 600; margin-bottom: 0.25rem;">Fine Amount</div>
                        <div style="font-size: 1.5rem; font-weight: 700;"><span class="pesos">{{ number_format($loan->fine->amount, 2) }}</span></div>
                    </div>
                    <div>
                        <span class="badge {{ $loan->fine->status == 'pending' ? 'badge-warning' : 'badge-success' }}">
                            {{ ucfirst($loan->fine->status) }}
                        </span>
                    </div>
                </div>
                @if($loan->fine->reason)
                    <p style="margin-top: 1rem; color: #6e6e73;">{{ $loan->fine->reason }}</p>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
