@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="stats-grid">
        <div class="stat-card" style="background: linear-gradient(135deg, #0071e3 0%, #0051b3 100%);">
            <div class="stat-icon">📚</div>
            <div class="stat-value">{{ number_format($totalBooks) }}</div>
            <div class="stat-label">Total Books</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #34c759 0%, #248a3d 100%);">
            <div class="stat-icon">👥</div>
            <div class="stat-value">{{ number_format($totalMembers) }}</div>
            <div class="stat-label">Active Members</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #ff9f0a 0%, #b06400 100%);">
            <div class="stat-icon">📖</div>
            <div class="stat-value">{{ number_format($activeLoans) }}</div>
            <div class="stat-label">Active Loans</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #ff3b30 0%, #bc1c1c 100%);">
            <div class="stat-icon">⏰</div>
            <div class="stat-value">{{ number_format($overdueLoans) }}</div>
            <div class="stat-label">Overdue Loans</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #5856d6 0%, #3634a3 100%);">
            <div class="stat-icon">💰</div>
            <div class="stat-value"><span class="pesos">{{ number_format($totalFines, 2) }}</span></div>
            <div class="stat-label">Pending Fines</div>
        </div>
    </div>

    <div class="grid-2">
        <!-- Recent Loans -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <span class="icon">📋</span>
                    Recent Loans
                </h2>
                <a href="{{ route('loans.index') }}" class="btn btn-primary">
                    <span class="icon">→</span>
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
                                <td><span style="font-family: monospace;">{{ $loan->loan_number }}</span></td>
                                <td>{{ Str::limit($loan->book->title, 30) }}</td>
                                <td>{{ $loan->member->name }}</td>
                                <td>{{ $loan->due_date->format('M d, Y') }}</td>
                                <td>
                                    @if($loan->status == 'active')
                                        <span class="badge badge-success">
                                            <span class="icon">✓</span>
                                            Active
                                        </span>
                                    @elseif($loan->status == 'overdue')
                                        <span class="badge badge-danger">
                                            <span class="icon">⚠️</span>
                                            Overdue
                                        </span>
                                    @else
                                        <span class="badge badge-info">
                                            <span class="icon">↩️</span>
                                            Returned
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <span class="icon">📥</span>
                                    <p>No recent loans</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Popular Books -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <span class="icon">⭐</span>
                    Popular Books
                </h2>
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                @forelse($popularBooks as $item)
                    <div style="display: flex; align-items: center; gap: 1rem; padding: 0.75rem; background: #f8f8fa; border-radius: 12px;">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, {{ ['#0071e3', '#34c759', '#ff9f0a', '#ff3b30', '#5856d6'][$loop->index % 5] }} 0%, {{ ['#0051b3', '#248a3d', '#b06400', '#bc1c1c', '#3634a3'][$loop->index % 5] }} 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                            📚
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600;">{{ Str::limit($item->book->title, 25) }}</div>
                            <div style="font-size: 0.85rem; color: #6e6e73;">{{ $item->total }} loans</div>
                        </div>
                        <div style="background: {{ ['#e5f0ff', '#e5f5e9', '#fff4e5', '#ffe9e9', '#ede9ff'][$loop->index % 5] }}; padding: 0.25rem 0.75rem; border-radius: 20px; color: {{ ['#0071e3', '#34c759', '#ff9f0a', '#ff3b30', '#5856d6'][$loop->index % 5] }}; font-weight: 600;">
                            {{ $item->total }}
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <span class="icon">📚</span>
                        <p>No data available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Monthly Statistics Chart -->
    <div class="card" style="margin-top: 1.5rem;">
        <div class="card-header">
            <h2>
                <span class="icon">📈</span>
                Monthly Activity
                <span style="font-size: 0.85rem; color: #6e6e73; margin-left: 0.5rem; font-weight: normal;">
                    (Last {{ count($monthlyStats) }} months)
                </span>
            </h2>
        </div>

        <div style="height: 250px; position: relative;">
            <div id="chartLoading" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(90deg, #f0f0f0 25%, #f8f8fa 50%, #f0f0f0 75%); background-size: 200% 100%; animation: loading 1.5s infinite; border-radius: 12px; z-index: 10; display: block;"></div>
            <canvas id="monthlyChart" style="position: relative; z-index: 20;"></canvas>
        </div>
    </div>

    <style>
        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }
    </style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    const loadingEl = document.getElementById('chartLoading');

    // Get data from controller
    const monthlyData = {!! json_encode($monthlyStats) !!};

    // Extract labels and data
    const labels = monthlyData.map(item => item.label);
    const loans = monthlyData.map(item => item.total_loans);
    const returns = monthlyData.map(item => item.returned);

    // Destroy existing chart if any
    const existingChart = Chart.getChart('monthlyChart');
    if (existingChart) {
        existingChart.destroy();
    }

    // Create chart
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Loans',
                    data: loans,
                    borderColor: '#0071e3',
                    backgroundColor: 'rgba(0, 113, 227, 0.05)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#0071e3',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Returns',
                    data: returns,
                    borderColor: '#34c759',
                    backgroundColor: 'rgba(52, 199, 89, 0.05)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#34c759',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1000,
                onComplete: function() {
                    if (loadingEl) {
                        loadingEl.style.display = 'none';
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8,
                        boxHeight: 8,
                        padding: 20,
                        font: {
                            size: 12,
                            family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif',
                            weight: '500'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.98)',
                    titleColor: '#1d1d1f',
                    bodyColor: '#6e6e73',
                    borderColor: '#f0f0f0',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 12,
                    boxPadding: 6,
                    usePointStyle: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f0f0f0',
                        drawBorder: false,
                        lineWidth: 1
                    },
                    ticks: {
                        color: '#6e6e73',
                        font: {
                            size: 11,
                            family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif',
                            weight: '400'
                        },
                        stepSize: 1,
                        callback: function(value) {
                            return Math.floor(value);
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6e6e73',
                        font: {
                            size: 11,
                            family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif',
                            weight: '400'
                        },
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
