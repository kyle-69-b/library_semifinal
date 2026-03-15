@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-pen-to-square" style="color: #ff9f0a;"></i>
            Edit Book: {{ $book->title }}
        </h2>
        <a href="{{ route('books.index') }}" class="btn">
            <i class="fa-regular fa-arrow-left"></i>
            Back
        </a>
    </div>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">ISBN <span style="color: #ff3b30;">*</span></label>
                <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}" required>
                @error('isbn') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Title <span style="color: #ff3b30;">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                @error('title') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Author <span style="color: #ff3b30;">*</span></label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
                @error('author') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Publisher</label>
                <input type="text" name="publisher" class="form-control" value="{{ old('publisher', $book->publisher) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Publication Year</label>
                <input type="number" name="publication_year" class="form-control" value="{{ old('publication_year', $book->publication_year) }}" min="1900" max="{{ date('Y') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Category <span style="color: #ff3b30;">*</span></label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $book->category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Quantity <span style="color: #ff3b30;">*</span></label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $book->quantity) }}" min="1" required>
                @error('quantity') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Shelf Location</label>
                <input type="text" name="shelf_location" class="form-control" value="{{ old('shelf_location', $book->shelf_location) }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $book->description) }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('books.index') }}" class="btn">Cancel</a>
            <button type="submit" class="btn btn-primary">
                <i class="fa-regular fa-floppy-disk"></i>
                Update Book
            </button>
        </div>
    </form>
</div>
@endsection
