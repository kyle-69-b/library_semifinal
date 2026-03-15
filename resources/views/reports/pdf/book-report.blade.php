<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Book Inventory Report</title>
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
            border-bottom: 2px solid #0071e3;
            padding-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: #0071e3;
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
            font-size: 12px;
        }
        th {
            background: #0071e3;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
        }
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #e8e8ed;
        }
        .category-badge {
            background: #e5f0ff;
            color: #0051b3;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 11px;
            display: inline-block;
        }
        .available {
            color: #34c759;
            font-weight: 600;
        }
        .unavailable {
            color: #ff3b30;
            font-weight: 600;
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
        <h1>📚 Book Inventory Report</h1>
        <p>Generated on: {{ $date }}</p>
        <p>Total Books: {{ $totalBooks }} | Available: {{ $totalAvailable }} | Borrowed: {{ $totalBorrowed }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="label">Total Books</div>
            <div class="value">{{ $totalBooks }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Available</div>
            <div class="value">{{ $totalAvailable }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Borrowed</div>
            <div class="value">{{ $totalBorrowed }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Available</th>
                <th>Total</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td><span class="category-badge">{{ $book->category->name }}</span></td>
                    <td class="{{ $book->available_quantity > 0 ? 'available' : 'unavailable' }}">
                        {{ $book->available_quantity }}
                    </td>
                    <td>{{ $book->quantity }}</td>
                    <td>{{ $book->shelf_location ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} LibSys - Library Management System</p>
    </div>
</body>
</html>
