@extends('layouts.app')

@section('title', 'Add Book')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-plus" style="color: #0071e3;"></i>
            Add New Book
        </h2>
        <a href="{{ route('books.index') }}" class="btn">
            <i class="fa-regular fa-arrow-left"></i>
            Back
        </a>
    </div>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">ISBN <span style="color: #ff3b30;">*</span></label>
                <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}" required placeholder="Enter ISBN">
                @error('isbn') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Title <span style="color: #ff3b30;">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required placeholder="Enter book title">
                @error('title') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Author <span style="color: #ff3b30;">*</span></label>
                <input type="text" name="author" class="form-control" value="{{ old('author') }}" required placeholder="Enter author name">
                @error('author') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Publisher</label>
                <input type="text" name="publisher" class="form-control" value="{{ old('publisher') }}" placeholder="Enter publisher">
            </div>

            <div class="form-group">
                <label class="form-label">Publication Year</label>
                <input type="number" name="publication_year" class="form-control" value="{{ old('publication_year', date('Y')) }}" min="1900" max="{{ date('Y') }}" placeholder="YYYY">
            </div>

            <div class="form-group">
                <label class="form-label">Category <span style="color: #ff3b30;">*</span></label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Quantity <span style="color: #ff3b30;">*</span></label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 1) }}" min="1" required placeholder="Enter quantity">
                @error('quantity') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Shelf Location</label>
                <input type="text" name="shelf_location" class="form-control" value="{{ old('shelf_location') }}" placeholder="e.g., A1, B2">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Enter book description">{{ old('description') }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('books.index') }}" class="btn">Cancel</a>
            <button type="submit" class="btn btn-primary">
                <i class="fa-regular fa-save"></i>
                Save Book
            </button>
        </div>
    </form>
</div>
@endsection
