<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Member Statistics Report</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #1d1d1f;
            margin: 0;
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #34c759;
            padding-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: #34c759;
            margin: 0 0 10px;
        }
        .header p {
            color: #6e6e73;
            margin: 5px 0;
            font-size: 14px;
        }
        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        .summary-item {
            background: #f5f5f7;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }
        .summary-item .label {
            font-size: 12px;
            color: #6e6e73;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .summary-item .value {
            font-size: 20px;
            font-weight: 700;
            color: #1d1d1f;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11px;
        }
        th {
            background: #34c759;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: 600;
        }
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #e8e8ed;
        }
        .status-active {
            background: #e5f5e9;
            color: #1e7b4c;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 10px;
            display: inline-block;
        }
        .status-inactive {
            background: #f5f5f7;
            color: #6e6e73;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 10px;
            display: inline-block;
        }
        .status-suspended {
            background: #ffe9e9;
            color: #bc1c1c;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 10px;
            display: inline-block;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #6e6e73;
            font-size: 11px;
            border-top: 1px solid #e8e8ed;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>👥 Member Statistics Report</h1>
        <p>Generated on: {{ $date }}</p>
        <p>Total Members: {{ $totalMembers }} | Active: {{ $activeMembers }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="label">Total Members</div>
            <div class="value">{{ $totalMembers }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Active</div>
            <div class="value">{{ $activeMembers }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Inactive</div>
            <div class="value">{{ $totalMembers - $activeMembers }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Member ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Member Since</th>
                <th>Expiry</th>
                <th>Status</th>
                <th>Total Loans</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td>{{ $member->member_id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone ?? 'N/A' }}</td>
                    <td>{{ $member->membership_date->format('M d, Y') }}</td>
                    <td>{{ $member->membership_expiry->format('M d, Y') }}</td>
                    <td>
                        @if($member->status == 'active')
                            <span class="status-active">Active</span>
                        @elseif($member->status == 'inactive')
                            <span class="status-inactive">Inactive</span>
                        @else
                            <span class="status-suspended">Suspended</span>
                        @endif
                    </td>
                    <td>{{ $member->loans_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} LibSys - Library Management System</p>
    </div>
</body>
</html>
