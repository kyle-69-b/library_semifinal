@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>
            <div class="card-header-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"/>
                    <line x1="12" y1="20" x2="12" y2="4"/>
                    <line x1="6"  y1="20" x2="6"  y2="14"/>
                </svg>
            </div>
            Generate Reports
        </h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.25rem;">

        {{-- Book Inventory --}}
        <div style="background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 1.75rem; display: flex; flex-direction: column; gap: 1.25rem; transition: box-shadow .2s, transform .2s;" onmouseover="this.style.boxShadow='var(--shadow-md)';this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)'">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 48px; height: 48px; background: var(--blue-light); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--blue);">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                </div>
                <div>
                    <h3 style="font-family: var(--font-serif); font-size: 1.05rem; font-weight: 400; color: var(--ink); letter-spacing: -0.01em;">Book Inventory</h3>
                    <p style="color: var(--ink-3); font-size: 0.82rem; margin-top: 0.15rem;">Books with availability status</p>
                </div>
            </div>

            <form action="{{ route('reports.books') }}" method="GET" style="display: flex; flex-direction: column; gap: 0.75rem;">
                <div style="position: relative;">
                    <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--ink-3); pointer-events: none; display: flex; align-items: center;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/>
                        </svg>
                    </span>
                    <select name="category_id" class="form-control" style="padding-left: 2.2rem;">
                        <option value="">All Categories</option>
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="12" y1="18" x2="12" y2="12"/>
                        <line x1="9" y1="15" x2="15" y2="15"/>
                    </svg>
                    Generate PDF
                </button>
            </form>
        </div>

        {{-- Loan Activity --}}
        <div style="background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 1.75rem; display: flex; flex-direction: column; gap: 1.25rem; transition: box-shadow .2s, transform .2s;" onmouseover="this.style.boxShadow='var(--shadow-md)';this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)'">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 48px; height: 48px; background: var(--green-light); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--green);">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </div>
                <div>
                    <h3 style="font-family: var(--font-serif); font-size: 1.05rem; font-weight: 400; color: var(--ink); letter-spacing: -0.01em;">Loan Activity</h3>
                    <p style="color: var(--ink-3); font-size: 0.82rem; margin-top: 0.15rem;">Track loans within a date range</p>
                </div>
            </div>

            <form action="{{ route('reports.loans') }}" method="GET" style="display: flex; flex-direction: column; gap: 0.75rem;">
                <div style="position: relative;">
                    <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--ink-3); pointer-events: none; display: flex; align-items: center;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </span>
                    <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-01') }}" required style="padding-left: 2.2rem;">
                </div>
                <div style="position: relative;">
                    <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--ink-3); pointer-events: none; display: flex; align-items: center;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </span>
                    <input type="date" name="end_date" class="form-control" value="{{ date('Y-m-d') }}" required style="padding-left: 2.2rem;">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="12" y1="18" x2="12" y2="12"/>
                        <line x1="9" y1="15" x2="15" y2="15"/>
                    </svg>
                    Generate PDF
                </button>
            </form>
        </div>

        {{-- Member Statistics --}}
        <div style="background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 1.75rem; display: flex; flex-direction: column; gap: 1.25rem; transition: box-shadow .2s, transform .2s;" onmouseover="this.style.boxShadow='var(--shadow-md)';this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)'">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 48px; height: 48px; background: var(--amber-light); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--amber);">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div>
                    <h3 style="font-family: var(--font-serif); font-size: 1.05rem; font-weight: 400; color: var(--ink); letter-spacing: -0.01em;">Member Statistics</h3>
                    <p style="color: var(--ink-3); font-size: 0.82rem; margin-top: 0.15rem;">Member data and borrowing history</p>
                </div>
            </div>

            <form action="{{ route('reports.members') }}" method="GET" style="display: flex; flex-direction: column; gap: 0.75rem;">
                {{-- Spacer to align button with other cards --}}
                <div style="height: 2.15rem;"></div>
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="12" y1="18" x2="12" y2="12"/>
                        <line x1="9" y1="15" x2="15" y2="15"/>
                    </svg>
                    Generate PDF
                </button>
            </form>
        </div>

        {{-- Fines Collection --}}
        <div style="background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 1.75rem; display: flex; flex-direction: column; gap: 1.25rem; transition: box-shadow .2s, transform .2s;" onmouseover="this.style.boxShadow='var(--shadow-md)';this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)'">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 48px; height: 48px; background: var(--red-light); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--red);">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="6" width="20" height="12" rx="2"/>
                        <circle cx="12" cy="12" r="2"/>
                        <path d="M6 12h.01M18 12h.01"/>
                    </svg>
                </div>
                <div>
                    <h3 style="font-family: var(--font-serif); font-size: 1.05rem; font-weight: 400; color: var(--ink); letter-spacing: -0.01em;">Fines Collection</h3>
                    <p style="color: var(--ink-3); font-size: 0.82rem; margin-top: 0.15rem;">Payments and outstanding balances</p>
                </div>
            </div>

            <form action="{{ route('reports.fines') }}" method="GET" style="display: flex; flex-direction: column; gap: 0.75rem;">
                <div style="position: relative;">
                    <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--ink-3); pointer-events: none; display: flex; align-items: center;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </span>
                    <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-01') }}" style="padding-left: 2.2rem;">
                </div>
                <div style="position: relative;">
                    <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--ink-3); pointer-events: none; display: flex; align-items: center;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </span>
                    <input type="date" name="end_date" class="form-control" value="{{ date('Y-m-d') }}" style="padding-left: 2.2rem;">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="12" y1="18" x2="12" y2="12"/>
                        <line x1="9" y1="15" x2="15" y2="15"/>
                    </svg>
                    Generate PDF
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
