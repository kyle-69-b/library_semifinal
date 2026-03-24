@extends('layouts.app')

@section('title', 'Books')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>
            <div class="card-header-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
            </div>
            Books Collection
        </h2>
        <div style="display: flex; gap: 0.75rem; align-items: center;">
            <form method="GET" action="{{ route('books.index') }}" style="display: flex; gap: 0;">
                {{-- Search input with icon inset --}}
                <div style="position: relative;">
                    <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--ink-3); pointer-events: none; display: flex; align-items: center;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                    </span>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search books..."
                        value="{{ request('search') }}"
                        style="width: 240px; padding-left: 2.2rem; border-radius: var(--radius-sm) 0 0 var(--radius-sm); border-right: none;"
                    >
                </div>
                <button type="submit" class="btn btn-primary" style="border-radius: 0 var(--radius-sm) var(--radius-sm) 0; padding: 0 1rem;">
                    Search
                </button>
            </form>
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Add Book
            </a>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Available</th>
                    <th>Total</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td><span style="font-family: monospace; font-size: 0.82rem; color: var(--ink-3);">{{ $book->isbn }}</span></td>
                        <td style="font-weight: 500; color: var(--ink);">{{ Str::limit($book->title, 40) }}</td>
                        <td>{{ $book->author }}</td>
                        <td><span class="badge badge-info">{{ $book->category->name }}</span></td>
                        <td>
                            @if($book->available_quantity > 0)
                                <span class="badge badge-success">{{ $book->available_quantity }} available</span>
                            @else
                                <span class="badge badge-danger">Unavailable</span>
                            @endif
                        </td>
                        <td style="color: var(--ink-3);">{{ $book->quantity }}</td>
                        <td style="color: var(--ink-3);">{{ $book->shelf_location ?? 'N/A' }}</td>
                        <td>
                            <div style="display: flex; gap: 0.4rem; align-items: center;">
                                {{-- View / Eye --}}
                                <a href="{{ route('books.show', $book) }}" class="btn" style="padding: 0.4rem 0.6rem;" title="View Details">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </a>
                                {{-- Edit / Pencil --}}
                                <a href="{{ route('books.edit', $book) }}" class="btn" style="padding: 0.4rem 0.6rem;" title="Edit Book">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                {{-- Delete / Trash --}}
                                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 0.4rem 0.6rem;" title="Delete Book">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                            <path d="M10 11v6"/><path d="M14 11v6"/>
                                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                                    </svg>
                                </div>
                                <p style="margin-bottom: 1rem;">No books found</p>
                                <a href="{{ route('books.create') }}" class="btn btn-primary">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="5" x2="12" y2="19"/>
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                    Add your first book
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1.5rem;">
        {{ $books->links('pagination.books-pagination') }}
    </div>
</div>
@endsection
