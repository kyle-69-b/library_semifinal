@extends('layouts.app')

@section('title', 'Member Details')

@section('content')
<div class="card" style="max-width: 1000px; margin: 0 auto;">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-user" style="color: #34c759;"></i>
            Member Details: {{ $member->name }}
        </h2>
        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('members.edit', $member) }}" class="btn btn-primary">
                <i class="fa-regular fa-pen"></i>
                Edit
            </a>
            <a href="{{ route('members.index') }}" class="btn">
                <i class="fa-regular fa-arrow-left"></i>
                Back
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
        <!-- Member Info -->
        <div>
            <div style="background: #f8f8fa; border-radius: 16px; padding: 1.5rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #34c759, #248a3d); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-regular fa-user" style="font-size: 3rem; color: white;"></i>
                    </div>
                    <h3 style="margin-top: 1rem; font-size: 1.25rem;">{{ $member->name }}</h3>
                    <p style="color: #6e6e73;">{{ $member->member_id }}</p>
                </div>

                <div style="border-top: 1px solid #e8e8ed; padding-top: 1rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">Status</span>
                        @if($member->status == 'active')
                            <span class="badge badge-success">
                                <i class="fa-regular fa-circle-check"></i> Active
                            </span>
                        @elseif($member->status == 'inactive')
                            <span class="badge badge-warning">
                                <i class="fa-regular fa-circle-pause"></i> Inactive
                            </span>
                        @else
                            <span class="badge badge-danger">
                                <i class="fa-regular fa-circle-exclamation"></i> Suspended
                            </span>
                        @endif
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">Email</span>
                        <span style="font-weight: 500;">{{ $member->email }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">Phone</span>
                        <span style="font-weight: 500;">{{ $member->phone ?? 'N/A' }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">Member Since</span>
                        <span style="font-weight: 500;">{{ $member->membership_date->format('M d, Y') }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: #6e6e73;">Expiry Date</span>
                        <span style="font-weight: 500;">{{ $member->membership_expiry->format('M d, Y') }}</span>
                    </div>

                    @if($member->address)
                        <div style="margin-top: 1rem;">
                            <span style="color: #6e6e73;">Address</span>
                            <p style="margin-top: 0.5rem;">{{ $member->address }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Loan History -->
        <div>
            <h3 style="margin-bottom: 1rem;">Loan History</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Book</th>
                            <th>Loan Date</th>
                            <th>Due Date</th>
                            <th>Return Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($member->loans as $loan)
                            <tr>
                                <td>{{ Str::limit($loan->book->title, 30) }}</td>
                                <td>{{ $loan->loan_date->format('M d, Y') }}</td>
                                <td>{{ $loan->due_date->format('M d, Y') }}</td>
                                <td>{{ $loan->return_date ? $loan->return_date->format('M d, Y') : '—' }}</td>
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
