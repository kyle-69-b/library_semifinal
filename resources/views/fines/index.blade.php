@extends('layouts.app')

@section('title', 'Fines')

@section('content')
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 1.5rem;">
    <div class="stat-card" style="background: linear-gradient(135deg, #ff9f0a 0%, #b06400 100%);">
        <div class="stat-icon">
            <i class="fa-regular fa-clock"></i>
        </div>
        <div class="stat-value"><span class="pesos">{{ number_format($totalPending, 2) }}</span></div>
        <div class="stat-label">Pending Fines</div>
    </div>

    <div class="stat-card" style="background: linear-gradient(135deg, #34c759 0%, #248a3d 100%);">
        <div class="stat-icon">
            <i class="fa-regular fa-circle-check"></i>
        </div>
        <div class="stat-value"><span class="pesos">{{ number_format($totalPaid, 2) }}</span></div>
        <div class="stat-label">Paid Fines</div>
    </div>

    <div class="stat-card" style="background: linear-gradient(135deg, #5856d6 0%, #3634a3 100%);">
        <div class="stat-icon">
            <i class="fa-regular fa-coins"></i>
        </div>
        <div class="stat-value"><span class="pesos">{{ number_format($totalCollected, 2) }}</span></div>
        <div class="stat-label">Total Collected</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-circle-exclamation" style="color: #ff3b30;"></i>
            Fines Management
        </h2>
        <form method="GET" action="{{ route('fines.index') }}" style="display: flex; gap: 0.5rem;">
            <select name="status" class="form-control" style="width: 150px;">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
            <button type="submit" class="btn btn-primary">
                <i class="fa-regular fa-filter"></i>
                Filter
            </button>
        </form>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Loan #</th>
                    <th>Member</th>
                    <th>Book</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fines as $fine)
                    <tr>
                        <td><span style="font-family: monospace;">{{ $fine->loan->loan_number }}</span></td>
                        <td>{{ $fine->loan->member->name }}</td>
                        <td>{{ Str::limit($fine->loan->book->title, 30) }}</td>
                        <td><span class="pesos">{{ number_format($fine->amount, 2) }}</span></td>
                        <td><span class="pesos">{{ number_format($fine->paid_amount, 2) }}</span></td>
                        <td>
                            @if($fine->remaining_amount > 0)
                                <span class="pesos" style="color: #ff3b30; font-weight: 600;">{{ number_format($fine->remaining_amount, 2) }}</span>
                            @else
                                <span style="color: #34c759;">—</span>
                            @endif
                        </td>
                        <td>
                            @if($fine->status == 'pending')
                                <span class="badge badge-warning">
                                    <i class="fa-regular fa-clock"></i>
                                    Pending
                                </span>
                            @else
                                <span class="badge badge-success">
                                    <i class="fa-regular fa-circle-check"></i>
                                    Paid
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('fines.show', $fine) }}" class="btn" style="padding: 0.4rem 0.8rem;">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                @if($fine->status == 'pending')
                                    <button onclick="document.getElementById('pay-form-{{ $fine->id }}').style.display='block'" class="btn btn-success" style="padding: 0.4rem 0.8rem;">
                                        <i class="fa-regular fa-credit-card"></i>
                                        Pay
                                    </button>
                                @endif
                            </div>

                            @if($fine->status == 'pending')
                                <form id="pay-form-{{ $fine->id }}" action="{{ route('fines.pay', $fine) }}" method="POST" style="display: none; margin-top: 0.5rem;">
                                    @csrf
                                    <div style="display: flex; gap: 0.5rem;">
                                        <input type="number" name="amount" class="form-control" placeholder="Amount" step="0.01" max="{{ $fine->remaining_amount }}" min="0.01" required style="width: 120px;">
                                        <button type="submit" class="btn btn-success">Confirm</button>
                                        <button type="button" onclick="document.getElementById('pay-form-{{ $fine->id }}').style.display='none'" class="btn">Cancel</button>
                                    </div>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <i class="fa-regular fa-circle-check"></i>
                            <p>No fines found</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1.5rem;">
        {{ $fines->links() }}
    </div>
</div>
@endsection
