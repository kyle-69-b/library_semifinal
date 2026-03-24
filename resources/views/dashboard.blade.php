@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- ── Stat Cards ──────────────────────────────────────────── --}}
    <div class="stats-grid">

        <div class="stat-card" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);">
            <div class="stat-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
            </div>
            <div class="stat-value">{{ number_format($totalBooks) }}</div>
            <div class="stat-label">Total Books</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #16a34a 0%, #14532d 100%);">
            <div class="stat-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="stat-value">{{ number_format($totalMembers) }}</div>
            <div class="stat-label">Active Members</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #d97706 0%, #92400e 100%);">
            <div class="stat-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            </div>
            <div class="stat-value">{{ number_format($activeLoans) }}</div>
            <div class="stat-label">Active Loans</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #dc2626 0%, #7f1d1d 100%);">
            <div class="stat-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <div class="stat-value">{{ number_format($overdueLoans) }}</div>
            <div class="stat-label">Overdue Loans</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #4f46e5 0%, #312e81 100%);">
            <div class="stat-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="6" width="20" height="12" rx="2"/>
                    <circle cx="12" cy="12" r="2"/>
                    <path d="M6 12h.01M18 12h.01"/>
                </svg>
            </div>
            <div class="stat-value"><span class="pesos">{{ number_format($totalFines, 2) }}</span></div>
            <div class="stat-label">Pending Fines</div>
        </div>

    </div>

    {{-- ── Recent Loans + Popular Books ────────────────────────── --}}
    <div class="grid-2">

        {{-- Recent Loans --}}
        <div class="card">
            <div class="card-header">
                <h2>
                    <div class="card-header-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                        </svg>
                    </div>
                    Recent Loans
                </h2>
                <a href="{{ route('loans.index') }}" class="btn btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                    View All
                </a>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Loan #</th>
                            <th>Book</th>
                            <th>Member</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentLoans as $loan)
                            <tr>
                                <td><span style="font-family: monospace; font-size: 0.82rem; color: var(--ink-3);">{{ $loan->loan_number }}</span></td>
                                <td style="color: var(--ink);">{{ Str::limit($loan->book->title, 28) }}</td>
                                <td>{{ $loan->member->name }}</td>
                                <td style="color: var(--ink-2);">{{ $loan->due_date->format('M d, Y') }}</td>
                                <td>
                                    @if($loan->status == 'active')
                                        <span class="badge badge-success">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                            Active
                                        </span>
                                    @elseif($loan->status == 'overdue')
                                        <span class="badge badge-danger">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                            Overdue
                                        </span>
                                    @else
                                        <span class="badge badge-info">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.5"/></svg>
                                            Returned
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                                <polyline points="14 2 14 8 20 8"/>
                                            </svg>
                                        </div>
                                        <p>No recent loans</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Popular Books --}}
        <div class="card">
            <div class="card-header">
                <h2>
                    <div class="card-header-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                    Popular Books
                </h2>
            </div>

            @php
                $gradients = [
                    ['#2563eb','#1d4ed8'],
                    ['#16a34a','#14532d'],
                    ['#d97706','#92400e'],
                    ['#dc2626','#7f1d1d'],
                    ['#4f46e5','#312e81'],
                ];
                $lightBg = ['var(--blue-light)','var(--green-light)','var(--amber-light)','var(--red-light)','#ede9ff'];
                $textCol = ['var(--blue)','var(--green)','var(--amber)','var(--red)','#4f46e5'];
            @endphp

            <div style="display: flex; flex-direction: column; gap: 0.6rem;">
                @forelse($popularBooks as $item)
                    @php $i = $loop->index % 5; @endphp
                    <div style="display: flex; align-items: center; gap: 0.9rem; padding: 0.75rem; background: var(--surface); border-radius: var(--radius); border: 1px solid var(--border);">
                        {{-- Rank badge --}}
                        <div style="width: 38px; height: 38px; background: linear-gradient(135deg, {{ $gradients[$i][0] }}, {{ $gradients[$i][1] }}); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                            </svg>
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-weight: 600; font-size: 0.875rem; color: var(--ink); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ Str::limit($item->book->title, 32) }}</div>
                            <div style="font-size: 0.78rem; color: var(--ink-3); margin-top: 1px;">{{ $item->book->author ?? '' }}</div>
                        </div>
                        <div style="background: {{ $lightBg[$i] }}; color: {{ $textCol[$i] }}; padding: 0.2rem 0.65rem; border-radius: 20px; font-size: 0.78rem; font-weight: 700; flex-shrink: 0;">
                            {{ $item->total }} loans
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                            </svg>
                        </div>
                        <p>No data available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ── Monthly Activity Chart ───────────────────────────────── --}}
    <div class="card" style="margin-top: 1.5rem;">
        <div class="card-header">
            <h2>
                <div class="card-header-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6"  y1="20" x2="6"  y2="14"/>
                    </svg>
                </div>
                Monthly Activity
                <span style="font-size: 0.8rem; color: var(--ink-3); margin-left: 0.4rem; font-weight: 400; font-family: var(--font-sans);">
                    Last {{ count($monthlyStats) }} months
                </span>
            </h2>
        </div>

        <div style="height: 260px; position: relative;">
            <div id="chartLoading" style="position: absolute; inset: 0; background: linear-gradient(90deg, var(--surface) 25%, var(--white) 50%, var(--surface) 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; border-radius: var(--radius); z-index: 10;"></div>
            <canvas id="monthlyChart" style="position: relative; z-index: 20;"></canvas>
        </div>
    </div>

    <style>
        @keyframes shimmer {
            0%   { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    const loadingEl = document.getElementById('chartLoading');
    const monthlyData = {!! json_encode($monthlyStats) !!};

    const labels  = monthlyData.map(d => d.label);
    const loans   = monthlyData.map(d => d.total_loans);
    const returns = monthlyData.map(d => d.returned);

    const existing = Chart.getChart('monthlyChart');
    if (existing) existing.destroy();

    new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Loans',
                    data: loans,
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37,99,235,0.06)',
                    borderWidth: 2,
                    pointBackgroundColor: '#2563eb',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.35,
                    fill: true
                },
                {
                    label: 'Returns',
                    data: returns,
                    borderColor: '#16a34a',
                    backgroundColor: 'rgba(22,163,74,0.06)',
                    borderWidth: 2,
                    pointBackgroundColor: '#16a34a',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.35,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 800,
                onComplete: () => { if (loadingEl) loadingEl.style.display = 'none'; }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8,
                        boxHeight: 8,
                        padding: 20,
                        color: '#3a3d4a',
                        font: { size: 12, weight: '500', family: "'DM Sans', sans-serif" }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255,255,255,0.98)',
                    titleColor: '#0f1117',
                    bodyColor: '#7a7f94',
                    borderColor: 'rgba(15,17,23,0.08)',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 10,
                    boxPadding: 5,
                    usePointStyle: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(15,17,23,0.05)', drawBorder: false },
                    ticks: {
                        color: '#7a7f94',
                        font: { size: 11, family: "'DM Sans', sans-serif" },
                        stepSize: 1,
                        callback: v => Math.floor(v)
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        color: '#7a7f94',
                        font: { size: 11, family: "'DM Sans', sans-serif" },
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            }
        }
    });
});
</script>
@endpush
