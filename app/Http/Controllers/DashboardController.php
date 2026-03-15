<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use App\Models\Fine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = Member::where('status', 'active')->count();
        $activeLoans = Loan::where('status', 'active')->count();
        $overdueLoans = Loan::where('status', 'overdue')->count();
       $totalFines = Fine::where('status', 'pending')->sum('amount');

        // Recent loans - limit to 5
        $recentLoans = Loan::with(['book', 'member'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Popular books - limit to 5
        $popularBooks = Loan::select('book_id', DB::raw('count(*) as total'))
            ->with('book')
            ->where('created_at', '>=', Carbon::now()->subMonths(3))
            ->groupBy('book_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // Monthly statistics - last 6 months only
        $monthlyStats = Loan::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('count(*) as total_loans'),
                DB::raw('sum(case when status = "returned" then 1 else 0 end) as returned')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => $item->month,
                    'year' => $item->year,
                    'total_loans' => $item->total_loans,
                    'returned' => $item->returned,
                    'label' => Carbon::create($item->year, $item->month, 1)->format('M Y')
                ];
            });

        return view('dashboard', compact(
            'totalBooks',
            'totalMembers',
            'activeLoans',
            'overdueLoans',
            'totalFines',
            'recentLoans',
            'popularBooks',
            'monthlyStats'
        ));
    }
}
