@extends('layouts.app')

@section('title', 'Members')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-users" style="color: #34c759;"></i>
            Library Members
        </h2>
        <div style="display: flex; gap: 1rem;">
            <form method="GET" action="{{ route('members.index') }}" style="display: flex; gap: 0.5rem;">
                <input type="text" name="search" class="form-control" placeholder="Search members..." value="{{ request('search') }}" style="width: 250px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </button>
            </form>
            <a href="{{ route('members.create') }}" class="btn btn-primary">
                <i class="fa-regular fa-plus"></i>
                Add Member
            </a>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Membership</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                    <tr>
                        <td><span style="font-family: monospace;">{{ $member->member_id }}</span></td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->phone ?? 'N/A' }}</td>
                        <td>{{ $member->membership_date->format('M d, Y') }}</td>
                        <td>
                            @if($member->status == 'active')
                                <span class="badge badge-success">
                                    <i class="fa-regular fa-circle-check"></i>
                                    Active
                                </span>
                            @elseif($member->status == 'inactive')
                                <span class="badge badge-warning">
                                    <i class="fa-regular fa-circle-pause"></i>
                                    Inactive
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    <i class="fa-regular fa-circle-exclamation"></i>
                                    Suspended
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('members.show', $member) }}" class="btn" style="padding: 0.4rem 0.8rem;">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <a href="{{ route('members.edit', $member) }}" class="btn" style="padding: 0.4rem 0.8rem;">
                                    <i class="fa-regular fa-pen"></i>
                                </a>
                                <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this member?')">
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
                        <td colspan="7" class="empty-state">
                            <i class="fa-regular fa-user"></i>
                            <p>No members found</p>
                            <a href="{{ route('members.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                                Add your first member
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1.5rem;">
        {{ $members->links() }}
    </div>
</div>
@endsection
