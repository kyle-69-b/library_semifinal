<!DOCTYPE html>
<html>
<head>
    <title>Loan Confirmation</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            margin: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
        }
        .content {
            padding: 40px;
        }
        .book-details {
            background: #f7fafc;
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 600;
            color: #4a5568;
        }
        .value {
            color: #2d3748;
        }
        .footer {
            text-align: center;
            padding: 30px;
            background: #f7fafc;
            color: #718096;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>📚 Book Loan Confirmation</h1>
        </div>

        <div class="content">
            <h2 style="color: #2d3748; margin-top: 0;">Hello {{ $loan->member->name }}!</h2>

            <p style="color: #4a5568; line-height: 1.6;">
                Your book loan has been successfully processed. Here are the details:
            </p>

            <div class="book-details">
                <div class="detail-row">
                    <span class="label">Loan Number:</span>
                    <span class="value">{{ $loan->loan_number }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Book Title:</span>
                    <span class="value">{{ $loan->book->title }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Author:</span>
                    <span class="value">{{ $loan->book->author }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Loan Date:</span>
                    <span class="value">{{ $loan->loan_date->format('F j, Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Due Date:</span>
                    <span class="value">{{ $loan->due_date->format('F j, Y') }}</span>
                </div>
            </div>

            <p style="color: #4a5568; line-height: 1.6;">
                Please return the book on or before the due date to avoid fines.
                You can return it to any of our library branches.
            </p>

            <a href="{{ route('loans.show', $loan) }}" class="btn">View Loan Details</a>
        </div>

        <div class="footer">
            <p>Thank you for using our Library Management System!</p>
            <p>&copy; {{ date('Y') }} LibraryMS. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
