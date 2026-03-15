<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Loan Activity Report</title>
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
            border-bottom: 2px solid #ff9f0a;
            padding-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: #ff9f0a;
            margin: 0 0 10px;
        }
        .header p {
            color: #6e6e73;
            margin: 5px 0;
            font-size: 14px;
        }
        .summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
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
            background: #ff9f0a;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: 600;
        }
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #e8e8ed;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 500;
            display: inline-block;
        }
        .badge-active {
            background: #e5f5e9;
            color: #1e7b4c;
        }
        .badge-returned {
            background: #e5f0ff;
            color: #0051b3;
        }
        .badge-overdue {
            background: #ffe9e9;
            color: #bc1c1c;
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
        <h1>📊 Loan Activity Report</h1>
        <p>Period: {{ $start_date }} to {{ $end_date }}</p>
        <p>Generated on: {{ $date }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="label">Total Loans</div>
            <div class="value">{{ $totalLoans }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Active</div>
            <div class="value">{{ $activeLoans }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Returned</div>
            <div class="value">{{ $returnedLoans }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Overdue</div>
            <div class="value">{{ $overdueLoans }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Loan #</th>
                <th>Book</th>
                <th>Member</th>
                <th>Loan Date</th>
                <th>Due Date</th>
                <th>Return Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
                <tr>
                    <td>{{ $loan->loan_number }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->member->name }}</td>
                    <td>{{ $loan->loan_date->format('M d, Y') }}</td>
                    <td>{{ $loan->due_date->format('M d, Y') }}</td>
                    <td>{{ $loan->return_date ? $loan->return_date->format('M d, Y') : '—' }}</td>
                    <td>
                        @if($loan->status == 'active')
                            <span class="badge badge-active">Active</span>
                        @elseif($loan->status == 'overdue')
                            <span class="badge badge-overdue">Overdue</span>
                        @else
                            <span class="badge badge-returned">Returned</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} LibSys - Library Management System</p>
    </div>
</body>
</html>
