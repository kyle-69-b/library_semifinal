@extends('layouts.app')

@section('title', 'Fines')

@section('content')

{{-- ── Stat Cards ──────────────────────────────────────────────── --}}
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; margin-bottom: 1.5rem;">

    {{-- Pending Fines --}}
    <div class="stat-card" style="background: linear-gradient(135deg, #d97706 0%, #92400e 100%);">
        <div class="stat-icon">
            {{-- Hourglass / pending --}}
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 22h14"/>
                <path d="M5 2h14"/>
                <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22"/>
                <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"/>
            </svg>
        </div>
        <div class="stat-value"><span class="pesos">{{ number_format($totalPending, 2) }}</span></div>
        <div class="stat-label">Pending Fines</div>
    </div>

    {{-- Paid Fines --}}
    <div class="stat-card" style="background: linear-gradient(135deg, #16a34a 0%, #14532d 100%);">
        <div class="stat-icon">
            {{-- Circle check / paid --}}
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <div class="stat-value"><span class="pesos">{{ number_format($totalPaid, 2) }}</span></div>
        <div class="stat-label">Paid Fines</div>
    </div>

    {{-- Total Collected --}}
    <div class="stat-card" style="background: linear-gradient(135deg, #4f46e5 0%, #312e81 100%);">
        <div class="stat-icon">
            {{-- Banknote / collected --}}
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="6" width="20" height="12" rx="2"/>
                <circle cx="12" cy="12" r="2"/>
                <path d="M6 12h.01M18 12h.01"/>
            </svg>
        </div>
        <div class="stat-value"><span class="pesos">{{ number_format($totalCollected, 2) }}</span></div>
        <div class="stat-label">Total Collected</div>
    </div>
</div>

{{-- ── Fines Table ─────────────────────────────────────────────── --}}
<div class="card">
    <div class="card-header">
        <h2>
            <div class="card-header-icon" style="background: var(--red-light); color: var(--red);">
                {{-- Alert triangle / fines --}}
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
            Fines Management
        </h2>
        <form method="GET" action="{{ route('fines.index') }}" style="display: flex; gap: 0; align-items: center;">
            <div style="position: relative;">
                <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--ink-3); pointer-events: none; display: flex; align-items: center;">
                    {{-- Sliders / filter icon --}}
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="4" y1="6" x2="20" y2="6"/>
                        <line x1="8" y1="12" x2="16" y2="12"/>
                        <line x1="11" y1="18" x2="13" y2="18"/>
                    </svg>
                </span>
                <select name="status" class="form-control" style="width: 160px; padding-left: 2.2rem; border-radius: var(--radius-sm) 0 0 var(--radius-sm); border-right: none;">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="border-radius: 0 var(--radius-sm) var(--radius-sm) 0; padding: 0 1rem;">
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
                        <td><span style="font-family: monospace; font-size: 0.82rem; color: var(--ink-3);">{{ $fine->loan->loan_number }}</span></td>
                        <td style="font-weight: 500;">{{ $fine->loan->member->name }}</td>
                        <td style="color: var(--ink-2);">{{ Str::limit($fine->loan->book->title, 30) }}</td>
                        <td><span class="pesos">{{ number_format($fine->amount, 2) }}</span></td>
                        <td><span class="pesos" style="color: var(--green);">{{ number_format($fine->paid_amount, 2) }}</span></td>
                        <td>
                            @if($fine->remaining_amount > 0)
                                <span class="pesos" style="color: var(--red); font-weight: 600;">{{ number_format($fine->remaining_amount, 2) }}</span>
                            @else
                                <span style="color: var(--green); font-size: 1.1rem; line-height: 1;">—</span>
                            @endif
                        </td>
                        <td>
                            @if($fine->status == 'pending')
                                <span class="badge badge-warning">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    Pending
                                </span>
                            @else
                                <span class="badge badge-success">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Paid
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.4rem; align-items: center;">
                                {{-- View --}}
                                <a href="{{ route('fines.show', $fine) }}" class="btn" style="padding: 0.4rem 0.6rem;" title="View Fine">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </a>
                                {{-- Pay --}}
                                @if($fine->status == 'pending')
                                    <button
                                        onclick="document.getElementById('pay-form-{{ $fine->id }}').style.display='block'; this.closest('div').style.display='none'"
                                        class="btn btn-success"
                                        style="padding: 0.4rem 0.7rem; font-size: 0.82rem; display: flex; align-items: center; gap: 0.35rem;"
                                        title="Record Payment"
                                    >
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="5" width="20" height="14" rx="2"/>
                                            <line x1="2" y1="10" x2="22" y2="10"/>
                                        </svg>
                                        Pay
                                    </button>
                                @endif
                            </div>

                            @if($fine->status == 'pending')
                                <form id="pay-form-{{ $fine->id }}" action="{{ route('fines.pay', $fine) }}" method="POST" style="display: none; margin-top: 0.5rem;">
                                    @csrf
                                    <div style="display: flex; gap: 0.4rem; align-items: center;">
                                        <input
                                            type="number"
                                            name="amount"
                                            class="form-control"
                                            placeholder="Amount"
                                            step="0.01"
                                            max="{{ $fine->remaining_amount }}"
                                            min="0.01"
                                            required
                                            style="width: 110px; font-size: 0.85rem; padding: 0.4rem 0.6rem;"
                                        >
                                        <button type="submit" class="btn btn-success" style="padding: 0.4rem 0.7rem; font-size: 0.82rem;">
                                            Confirm
                                        </button>
                                        <button
                                            type="button"
                                            onclick="document.getElementById('pay-form-{{ $fine->id }}').style.display='none'; this.closest('td').querySelector('div').style.display='flex'"
                                            class="btn"
                                            style="padding: 0.4rem 0.7rem; font-size: 0.82rem;"
                                        >
                                            Cancel
                                        </button>
                                    </div>
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
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                        <polyline points="22 4 12 14.01 9 11.01"/>
                                    </svg>
                                </div>
                                <p>No fines found</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1.5rem;">
       {{ $fines->links('pagination.books-pagination') }}
    </div>
</div>
@endsection
