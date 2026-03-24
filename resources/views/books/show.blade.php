@extends('layouts.app')

@section('title', 'Book Details')

@section('content')
<div class="card" style="max-width: 1000px; margin: 0 auto;">
    <div class="card-header">
        <h2>
            <div class="card-header-icon">
                {{-- Book open icon --}}
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
            </div>
            Book Details: {{ $book->title }}
        </h2>
        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('books.edit', $book) }}" class="btn btn-primary">
                {{-- Pencil / edit icon --}}
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit
            </a>
            <a href="{{ route('books.index') }}" class="btn">
                {{-- Arrow left icon --}}
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"/>
                    <polyline points="12 19 5 12 12 5"/>
                </svg>
                Back
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
        {{-- Book Info Panel --}}
        <div>
            <div style="background: var(--surface); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border);">
                {{-- Book Cover Placeholder --}}
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div style="width: 110px; height: 110px; background: var(--ink); border-radius: var(--radius-lg); margin: 0 auto; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-md);">
                        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        </svg>
                    </div>
                </div>

                <div style="border-top: 1px solid var(--border); padding-top: 1rem; display: flex; flex-direction: column; gap: 0.7rem;">

                    {{-- ISBN --}}
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--ink-3); font-size: 0.85rem; display: flex; align-items: center; gap: 0.4rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="16" rx="2"/><line x1="7" y1="9" x2="17" y2="9"/><line x1="7" y1="13" x2="13" y2="13"/>
                            </svg>
                            ISBN
                        </span>
                        <span style="font-weight: 500; font-family: monospace; font-size: 0.85rem;">{{ $book->isbn }}</span>
                    </div>

                    {{-- Author --}}
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--ink-3); font-size: 0.85rem; display: flex; align-items: center; gap: 0.4rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                            Author
                        </span>
                        <span style="font-weight: 500; font-size: 0.875rem;">{{ $book->author }}</span>
                    </div>

                    {{-- Publisher --}}
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--ink-3); font-size: 0.85rem; display: flex; align-items: center; gap: 0.4rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                            Publisher
                        </span>
                        <span style="font-weight: 500; font-size: 0.875rem;">{{ $book->publisher ?? 'N/A' }}</span>
                    </div>

                    {{-- Year --}}
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--ink-3); font-size: 0.85rem; display: flex; align-items: center; gap: 0.4rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            Year
                        </span>
                        <span style="font-weight: 500; font-size: 0.875rem;">{{ $book->publication_year ?? 'N/A' }}</span>
                    </div>

                    {{-- Category --}}
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--ink-3); font-size: 0.85rem; display: flex; align-items: center; gap: 0.4rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/>
                            </svg>
                            Category
                        </span>
                        <span class="badge badge-info">{{ $book->category->name }}</span>
                    </div>

                    {{-- Location --}}
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--ink-3); font-size: 0.85rem; display: flex; align-items: center; gap: 0.4rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                            </svg>
                            Location
                        </span>
                        <span style="font-weight: 500; font-size: 0.875rem;">{{ $book->shelf_location ?? 'Not assigned' }}</span>
                    </div>

                    {{-- Availability --}}
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
                        <span style="color: var(--ink-3); font-size: 0.85rem; display: flex; align-items: center; gap: 0.4rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                            </svg>
                            Available
                        </span>
                        @if($book->available_quantity > 0)
                            <span class="badge badge-success">{{ $book->available_quantity }} of {{ $book->quantity }}</span>
                        @else
                            <span class="badge badge-danger">Unavailable</span>
                        @endif
                    </div>
                </div>

                @if($book->description)
                    <div style="margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid var(--border);">
                        <p style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.07em; color: var(--ink-3); margin-bottom: 0.5rem;">Description</p>
                        <p style="color: var(--ink-2); font-size: 0.875rem; line-height: 1.6;">{{ $book->description }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Loan History --}}
        <div>
            <h3 style="font-family: var(--font-serif); font-weight: 400; font-size: 1.1rem; margin-bottom: 1rem; color: var(--ink); display: flex; align-items: center; gap: 0.5rem;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ink-3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
                Loan History
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Loan #</th>
                            <th>Member</th>
                            <th>Loan Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($book->loans as $loan)
                            <tr>
                                <td><span style="font-family: monospace; font-size: 0.85rem;">{{ $loan->loan_number }}</span></td>
                                <td>{{ $loan->member->name }}</td>
                                <td>{{ $loan->loan_date->format('M d, Y') }}</td>
                                <td>{{ $loan->due_date->format('M d, Y') }}</td>
                                <td>
                                    @if($loan->status == 'active')
                                        <span class="badge badge-success">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/></svg>
                                            Active
                                        </span>
                                    @elseif($loan->status == 'overdue')
                                        <span class="badge badge-danger">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/></svg>
                                            Overdue
                                        </span>
                                    @else
                                        <span class="badge badge-info">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
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
                                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                                            </svg>
                                        </div>
                                        <p>No loan history for this book</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
