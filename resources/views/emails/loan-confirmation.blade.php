<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Book Loan Confirmation</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #1d1d1f;
            background-color: #f5f5f7;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }
        .header {
            background: linear-gradient(135deg, #0071e3, #0051b3);
            padding: 30px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1d1d1f;
        }
        .details {
            background: #f8f8fa;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e8e8ed;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 500;
            color: #6e6e73;
        }
        .value {
            font-weight: 600;
            color: #1d1d1f;
        }
        .book-info {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin: 20px 0;
            border-left: 4px solid #0071e3;
        }
        .warning {
            background: #fff4e5;
            border-radius: 12px;
            padding: 15px;
            margin: 20px 0;
            border-left: 4px solid #ff9f0a;
        }
        .footer {
            background: #f8f8fa;
            padding: 20px;
            text-align: center;
            color: #6e6e73;
            font-size: 12px;
        }
        .btn {
            display: inline-block;
            background: #0071e3;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 500;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📚 Book Loan Confirmation</h1>
            <p>Transaction Receipt</p>
        </div>

        <div class="content">
            <div class="greeting">
                Hello {{ $loan->member->name }}!
            </div>

            <p>Thank you for borrowing from our library. Here are your loan details:</p>

            <div class="details">
                <div class="detail-row">
                    <span class="label">Loan Number:</span>
                    <span class="value">{{ $loan->loan_number }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Loan Date:</span>
                    <span class="value">{{ $loan->loan_date->format('F d, Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Due Date:</span>
                    <span class="value">{{ $loan->due_date->format('F d, Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Days to Return:</span>
                    <span class="value">{{ $loan->loan_date->diffInDays($loan->due_date) }} days</span>
                </div>
            </div>

            <div class="book-info">
                <div class="detail-row">
                    <span class="label">Book Title:</span>
                    <span class="value">{{ $loan->book->title }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Author:</span>
                    <span class="value">{{ $loan->book->author }}</span>
                </div>
                @if($loan->book->isbn)
                <div class="detail-row">
                    <span class="label">ISBN:</span>
                    <span class="value">{{ $loan->book->isbn }}</span>
                </div>
                @endif
            </div>

            <div class="warning">
                <strong>⚠️ Important Reminder:</strong>
                <p style="margin: 8px 0 0 0; font-size: 14px;">
                    Please return the book on or before the due date to avoid fines.
                    A fee of ₱1.00 per day will be charged for overdue books.
                </p>
            </div>

            <div style="text-align: center;">
                <a href="{{ url('/member/loans') }}" class="btn">View My Loans</a>
            </div>
        </div>

        <div class="footer">
            <p>This is an automated message from the Library Management System.</p>
            <p>© {{ date('Y') }} LibSys. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
