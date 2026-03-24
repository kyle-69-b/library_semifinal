@extends('layouts.app')

@section('title', 'Loans')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>
            <div class="card-header-icon" style="background: var(--amber-light); color: var(--amber);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            </div>
            Book Loans
        </h2>
        <div style="display: flex; gap: 0.75rem; align-items: center;">
            <form method="GET" action="{{ route('loans.index') }}" style="display: flex; gap: 0;">
                <div style="position: relative;">
                    <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--ink-3); pointer-events: none; display: flex; align-items: center;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" y1="6" x2="20" y2="6"/>
                            <line x1="8" y1="12" x2="16" y2="12"/>
                            <line x1="11" y1="18" x2="13" y2="18"/>
                        </svg>
                    </span>
                    <select name="status" class="form-control" style="width: 180px; padding-left: 2.2rem; border-radius: var(--radius-sm) 0 0 var(--radius-sm); border-right: none;">
                        <option value="">All Status</option>
                        <option value="active"   {{ request('status') == 'active'   ? 'selected' : '' }}>Active</option>
                        <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                        <option value="overdue"  {{ request('status') == 'overdue'  ? 'selected' : '' }}>Overdue</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="border-radius: 0 var(--radius-sm) var(--radius-sm) 0; padding: 0 1rem;">
                    Filter
                </button>
            </form>
            <a href="{{ route('loans.create') }}" class="btn btn-primary">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
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
                        <td><span style="font-family: monospace; font-size: 0.82rem; color: var(--ink-3);">{{ $loan->loan_number }}</span></td>
                        <td style="color: var(--ink); font-weight: 500;">{{ Str::limit($loan->book->title, 30) }}</td>
                        <td>{{ $loan->member->name }}</td>
                        <td style="color: var(--ink-2);">{{ $loan->loan_date->format('M d, Y') }}</td>
                        <td style="color: var(--ink-2);">{{ $loan->due_date->format('M d, Y') }}</td>
                        <td style="color: var(--ink-2);">{{ $loan->return_date ? $loan->return_date->format('M d, Y') : '—' }}</td>
                        <td>
                            @if($loan->status == 'active')
                                <span class="badge badge-success">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Active
                                </span>
                            @elseif($loan->status == 'overdue')
                                <span class="badge badge-danger">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="12" y1="8" x2="12" y2="12"/>
                                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                                    </svg>
                                    Overdue
                                </span>
                            @else
                                <span class="badge badge-info">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="1 4 1 10 7 10"/>
                                        <path d="M3.51 15a9 9 0 1 0 .49-3.5"/>
                                    </svg>
                                    Returned
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.4rem; align-items: center;" id="actions-{{ $loan->id }}">
                                {{-- View --}}
                                <a href="{{ route('loans.show', $loan) }}" class="btn" style="padding: 0.4rem 0.6rem;" title="View Loan">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </a>
                                {{-- Return --}}
                                @if($loan->status != 'returned')
                                    <button
                                        onclick="document.getElementById('return-form-{{ $loan->id }}').style.display='flex'; document.getElementById('actions-{{ $loan->id }}').style.display='none'"
                                        class="btn btn-success"
                                        style="padding: 0.4rem 0.7rem; font-size: 0.82rem; display: flex; align-items: center; gap: 0.35rem;"
                                        title="Return Book"
                                    >
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="1 4 1 10 7 10"/>
                                            <path d="M3.51 15a9 9 0 1 0 .49-3.5"/>
                                        </svg>
                                        Return
                                    </button>
                                @endif
                            </div>

                            @if($loan->status != 'returned')
                                <form id="return-form-{{ $loan->id }}" action="{{ route('loans.return', $loan) }}" method="POST" style="display: none; margin-top: 0.5rem; flex-wrap: wrap; gap: 0.4rem; align-items: center;">
                                    @csrf
                                    <input
                                        type="date"
                                        name="return_date"
                                        class="form-control"
                                        value="{{ date('Y-m-d') }}"
                                        required
                                        style="width: 145px; font-size: 0.85rem; padding: 0.4rem 0.6rem;"
                                    >
                                    <button type="submit" class="btn btn-success" style="padding: 0.4rem 0.7rem; font-size: 0.82rem;">
                                        Confirm
                                    </button>
                                    <button
                                        type="button"
                                        onclick="document.getElementById('return-form-{{ $loan->id }}').style.display='none'; document.getElementById('actions-{{ $loan->id }}').style.display='flex'"
                                        class="btn"
                                        style="padding: 0.4rem 0.7rem; font-size: 0.82rem;"
                                    >
                                        Cancel
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                    </svg>
                                </div>
                                <p style="margin-bottom: 1rem;">No loans found</p>
                                <a href="{{ route('loans.create') }}" class="btn btn-primary">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="5" x2="12" y2="19"/>
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                    Create your first loan
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1.5rem;">
        {{ $loans->links('pagination.books-pagination') }}
    </div>
</div>
@endsection
