@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-chart-line"></i>
            Generate Reports
        </h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
        <!-- Book Report -->
        <div class="card" style="padding: 2rem; text-align: center;">
            <div style="width: 64px; height: 64px; background: #f5f5f7; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fa-regular fa-book-open" style="font-size: 2rem; color: #0071e3;"></i>
            </div>
            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">Book Inventory</h3>
            <p style="color: #6e6e73; font-size: 0.95rem; margin-bottom: 1.5rem;">Complete list of all books with availability status</p>

            <form action="{{ route('reports.books') }}" method="GET" style="display: flex; flex-direction: column; gap: 1rem;">
                <select name="category_id" class="form-control">
                    <option value="">All Categories</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fa-regular fa-file-pdf"></i>
                    Generate PDF
                </button>
            </form>
        </div>

        <!-- Loan Report -->
        <div class="card" style="padding: 2rem; text-align: center;">
            <div style="width: 64px; height: 64px; background: #f5f5f7; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fa-regular fa-hand-holding-hand" style="font-size: 2rem; color: #34c759;"></i>
            </div>
            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">Loan Activity</h3>
            <p style="color: #6e6e73; font-size: 0.95rem; margin-bottom: 1.5rem;">Track all loan transactions within a date range</p>

            <form action="{{ route('reports.loans') }}" method="GET" style="display: flex; flex-direction: column; gap: 1rem;">
                <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-01') }}" required>
                <input type="date" name="end_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fa-regular fa-file-pdf"></i>
                    Generate PDF
                </button>
            </form>
        </div>

        <!-- Member Report -->
        <div class="card" style="padding: 2rem; text-align: center;">
            <div style="width: 64px; height: 64px; background: #f5f5f7; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fa-regular fa-users" style="font-size: 2rem; color: #ff9f0a;"></i>
            </div>
            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">Member Statistics</h3>
            <p style="color: #6e6e73; font-size: 0.95rem; margin-bottom: 1.5rem;">Comprehensive member data and borrowing history</p>

            <form action="{{ route('reports.members') }}" method="GET">
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fa-regular fa-file-pdf"></i>
                    Generate PDF
                </button>
            </form>
        </div>

        <!-- Fine Report -->
        <div class="card" style="padding: 2rem; text-align: center;">
            <div style="width: 64px; height: 64px; background: #f5f5f7; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fa-regular fa-coins" style="font-size: 2rem; color: #ff3b30;"></i>
            </div>
            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">Fines Collection</h3>
            <p style="color: #6e6e73; font-size: 0.95rem; margin-bottom: 1.5rem;">Track fines, payments, and outstanding balances</p>

            <form action="{{ route('reports.fines') }}" method="GET" style="display: flex; flex-direction: column; gap: 1rem;">
                <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-01') }}">
                <input type="date" name="end_date" class="form-control" value="{{ date('Y-m-d') }}">
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fa-regular fa-file-pdf"></i>
                    Generate PDF
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
