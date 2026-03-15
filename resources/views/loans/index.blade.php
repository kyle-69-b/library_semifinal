@extends('layouts.app')

@section('title', 'Loans')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-hand-holding-hand" style="color: #ff9f0a;"></i>
            Book Loans
        </h2>
        <div style="display: flex; gap: 1rem;">
            <form method="GET" action="{{ route('loans.index') }}" style="display: flex; gap: 0.5rem;">
                <select name="status" class="form-control" style="width: 150px;">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-regular fa-filter"></i>
                    Filter
                </button>
            </form>
            <a href="{{ route('loans.create') }}" class="btn btn-primary">
                <i class="fa-regular fa-plus"></i>
                New Loan
            </a>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Loan #</th>
                    <th>Book</th>
                    <th>Member</th>
                    <th>Loan Date</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td><span style="font-family: monospace;">{{ $loan->loan_number }}</span></td>
                        <td>{{ Str::limit($loan->book->title, 30) }}</td>
                        <td>{{ $loan->member->name }}</td>
                        <td>{{ $loan->loan_date->format('M d, Y') }}</td>
                        <td>{{ $loan->due_date->format('M d, Y') }}</td>
                        <td>{{ $loan->return_date ? $loan->return_date->format('M d, Y') : '—' }}</td>
                        <td>
                            @if($loan->status == 'active')
                                <span class="badge badge-success">
                                    <i class="fa-regular fa-circle-check"></i>
                                    Active
                                </span>
                            @elseif($loan->status == 'overdue')
                                <span class="badge badge-danger">
                                    <i class="fa-regular fa-circle-exclamation"></i>
                                    Overdue
                                </span>
                            @else
                                <span class="badge badge-info">
                                    <i class="fa-regular fa-rotate-left"></i>
                                    Returned
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('loans.show', $loan) }}" class="btn" style="padding: 0.4rem 0.8rem;">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                @if($loan->status != 'returned')
                                    <button onclick="document.getElementById('return-form-{{ $loan->id }}').style.display='block'" class="btn btn-success" style="padding: 0.4rem 0.8rem;">
                                        <i class="fa-regular fa-rotate-right"></i>
                                        Return
                                    </button>
                                @endif
                            </div>

                            @if($loan->status != 'returned')
                                <form id="return-form-{{ $loan->id }}" action="{{ route('loans.return', $loan) }}" method="POST" style="display: none; margin-top: 0.5rem;">
                                    @csrf
                                    <div style="display: flex; gap: 0.5rem;">
                                        <input type="date" name="return_date" class="form-control" value="{{ date('Y-m-d') }}" required style="width: 150px;">
                                        <button type="submit" class="btn btn-success">Confirm Return</button>
                                        <button type="button" onclick="document.getElementById('return-form-{{ $loan->id }}').style.display='none'" class="btn">Cancel</button>
                                    </div>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <i class="fa-regular fa-hand-holding-hand"></i>
                            <p>No loans found</p>
                            <a href="{{ route('loans.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                Create your first loan
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1.5rem;">
        {{ $loans->links() }}
    </div>
</div>
@endsection
