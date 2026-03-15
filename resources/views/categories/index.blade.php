@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-tags"></i>
            Categories
        </h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fa-regular fa-plus"></i>
            New Category
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Books</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ Str::limit($category->description, 50) }}</td>
                        <td>
                            <span class="badge badge-info">{{ $category->books_count }} books</span>
                        </td>
                        <td>{{ $category->created_at->format('M d, Y') }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('categories.edit', $category) }}" class="btn" style="padding: 0.4rem 0.8rem;">
                                    <i class="fa-regular fa-pen"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                        <td colspan="5" class="empty-state">
                            <i class="fa-regular fa-tag"></i>
                            <p>No categories found</p>
                            <a href="{{ route('categories.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                Create your first category
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1.5rem;">
        {{ $categories->links() }}
    </div>
</div>
@endsection
