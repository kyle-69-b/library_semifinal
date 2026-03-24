<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Loan;
use App\Observers\LoanObserver;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('pagination.books-pagination');
        Loan::observe(LoanObserver::class);
    }
}
