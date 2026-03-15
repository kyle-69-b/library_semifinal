@extends('layouts.app')

@section('title', 'Book Details')

@section('content')
<div class="card" style="max-width: 1000px; margin: 0 auto;">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-book-open" style="color: #0071e3;"></i>
            Book Details: {{ $book->title }}
        </h2>
        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('books.edit', $book) }}" class="btn btn-primary">
                <i class="fa-regular fa-pen"></i>
                Edit
            </a>
            <a href="{{ route('books.index') }}" class="btn">
                <i class="fa-regular fa-arrow-left"></i>
                Back
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
        <!-- Book Info -->
        <div>
            <div style="background: #f8f8fa; border-radius: 16px; padding: 1.5rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div style="width: 120px; height: 120px; background: linear-gradient(135deg, #0071e3, #0051b3); border-radius: 20px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-regular fa-book-open" style="font-size: 3rem; color: white;"></i>
                    </div>
                </div>

                <div style="border-top: 1px solid #e8e8ed; padding-top: 1rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">ISBN</span>
                        <span style="font-weight: 500; font-family: monospace;">{{ $book->isbn }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">Author</span>
                        <span style="font-weight: 500;">{{ $book->author }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">Publisher</span>
                        <span style="font-weight: 500;">{{ $book->publisher ?? 'N/A' }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">Year</span>
                        <span style="font-weight: 500;">{{ $book->publication_year ?? 'N/A' }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">Category</span>
                        <span class="badge badge-info">{{ $book->category->name }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">Location</span>
                        <span style="font-weight: 500;">{{ $book->shelf_location ?? 'Not assigned' }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">Availability</span>
                        @if($book->available_quantity > 0)
                            <span class="badge badge-success">{{ $book->available_quantity }} of {{ $book->quantity }} available</span>
                        @else
                            <span class="badge badge-danger">Unavailable</span>
                        @endif
                    </div>
                </div>

                @if($book->description)
                    <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e8e8ed;">
                        <h4 style="margin-bottom: 0.5rem;">Description</h4>
                        <p style="color: #6e6e73; line-height: 1.6;">{{ $book->description }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Loan History -->
        <div>
            <h3 style="margin-bottom: 1rem;">Loan History</h3>
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
                                <td><span style="font-family: monospace;">{{ $loan->loan_number }}</span></td>
                                <td>{{ $loan->member->name }}</td>
                                <td>{{ $loan->loan_date->format('M d, Y') }}</td>
                                <td>{{ $loan->due_date->format('M d, Y') }}</td>
                                <td>
                                    @if($loan->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($loan->status == 'overdue')
                                        <span class="badge badge-danger">Overdue</span>
                                    @else
                                        <span class="badge badge-info">Returned</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <i class="fa-regular fa-book"></i>
                                    <p>No loan history</p>
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
