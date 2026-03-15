@extends('layouts.app')

@section('title', 'Books')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-book-open" style="color: #0071e3;"></i>
            Books Collection
        </h2>
        <div style="display: flex; gap: 1rem;">
            <form method="GET" action="{{ route('books.index') }}" style="display: flex; gap: 0.5rem;">
                <input type="text" name="search" class="form-control" placeholder="Search books..." value="{{ request('search') }}" style="width: 250px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </button>
            </form>
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <i class="fa-regular fa-plus"></i>
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
                        <td><span style="font-family: monospace;">{{ $book->isbn }}</span></td>
                        <td>{{ Str::limit($book->title, 40) }}</td>
                        <td>{{ $book->author }}</td>
                        <td><span class="badge badge-info">{{ $book->category->name }}</span></td>
                        <td>
                            @if($book->available_quantity > 0)
                                <span class="badge badge-success">{{ $book->available_quantity }} available</span>
                            @else
                                <span class="badge badge-danger">Unavailable</span>
                            @endif
                        </td>
                        <td>{{ $book->quantity }}</td>
                        <td>{{ $book->shelf_location ?? 'N/A' }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('books.show', $book) }}" class="btn" style="padding: 0.4rem 0.8rem;">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <a href="{{ route('books.edit', $book) }}" class="btn" style="padding: 0.4rem 0.8rem;">
                                    <i class="fa-regular fa-pen"></i>
                                </a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 0.4rem 0.8rem;">
                                        <i class="fa-regular fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <i class="fa-regular fa-books"></i>
                            <p>No books found</p>
                            <a href="{{ route('books.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                Add your first book
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1.5rem;">
        {{ $books->links() }}
    </div>
</div>
@endsection
