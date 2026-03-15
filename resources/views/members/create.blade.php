@extends('layouts.app')

@section('title', 'Add Member')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header">
        <h2>
            <i class="fa-regular fa-user-plus" style="color: #34c759;"></i>
            Add New Member
        </h2>
        <a href="{{ route('members.index') }}" class="btn">
            <i class="fa-regular fa-arrow-left"></i>
            Back
        </a>
    </div>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Member ID <span style="color: #ff3b30;">*</span></label>
                <input type="text" name="member_id" class="form-control" value="{{ old('member_id', 'MEM-' . strtoupper(Str::random(6))) }}" required>
                @error('member_id') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Full Name <span style="color: #ff3b30;">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Enter full name">
                @error('name') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email <span style="color: #ff3b30;">*</span></label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="Enter email address">
                @error('email') <span style="color: #ff3b30; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter phone number">
            </div>

            <div class="form-group">
                <label class="form-label">Membership Date <span style="color: #ff3b30;">*</span></label>
                <input type="date" name="membership_date" class="form-control" value="{{ old('membership_date', date('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Membership Expiry <span style="color: #ff3b30;">*</span></label>
                <input type="date" name="membership_expiry" class="form-control" value="{{ old('membership_expiry', date('Y-m-d', strtotime('+1 year'))) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Status <span style="color: #ff3b30;">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" rows="3" placeholder="Enter complete address">{{ old('address') }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('members.index') }}" class="btn">Cancel</a>
            <button type="submit" class="btn btn-primary">
                <i class="fa-regular fa-floppy-disk"></i>
                Save Member
            </button>
        </div>
    </form>
</div>
@endsection
