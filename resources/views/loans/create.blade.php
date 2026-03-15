@extends('layouts.app')

@section('title', 'New Loan')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-hand-holding-hand" style="color: #ff9f0a;"></i>
            Create New Loan
        </h2>
        <a href="{{ route('loans.index') }}" class="btn">
            <i class="fa-regular fa-arrow-left"></i>
            Back
        </a>
    </div>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Select Book <span style="color: #ff3b30;">*</span></label>
                <select name="book_id" class="form-control" required id="bookSelect">
                    <option value="">Choose a book...</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" data-available="{{ $book->available_quantity }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                            {{ $book->title }} by {{ $book->author }} ({{ $book->available_quantity }} available)
                        </option>
                    @endforeach
                </select>
                @error('book_id') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Select Member <span style="color: #ff3b30;">*</span></label>
                <select name="member_id" class="form-control" required>
                    <option value="">Choose a member...</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }} ({{ $member->member_id }})
                        </option>
                    @endforeach
                </select>
                @error('member_id') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Loan Date <span style="color: #ff3b30;">*</span></label>
                <input type="date" name="loan_date" class="form-control" value="{{ old('loan_date', date('Y-m-d')) }}" required>
                @error('loan_date') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Due Date <span style="color: #ff3b30;">*</span></label>
                <input type="date" name="due_date" class="form-control" value="{{ old('due_date', date('Y-m-d', strtotime('+14 days'))) }}" required>
                @error('due_date') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3" placeholder="Any additional notes...">{{ old('notes') }}</textarea>
        </div>

        <div id="availabilityWarning" style="display: none; background: #fff4e5; color: #b06400; padding: 1rem; border-radius: 12px; margin-bottom: 1rem;">
            <i class="fa-regular fa-circle-exclamation"></i>
            <span id="warningMessage"></span>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('loans.index') }}" class="btn">Cancel</a>
            <button type="submit" class="btn btn-primary">
                <i class="fa-regular fa-hand-holding-hand"></i>
                Create Loan
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('bookSelect').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    const available = selected.dataset.available;
    const warning = document.getElementById('availabilityWarning');
    const message = document.getElementById('warningMessage');

    if (available == 0) {
        warning.style.display = 'block';
        message.textContent = 'This book is currently unavailable. Please select another book.';
    } else {
        warning.style.display = 'none';
    }
});
</script>
@endsection
