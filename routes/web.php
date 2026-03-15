<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\ReportController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Books
    Route::resource('books', BookController::class);

    // Members
    Route::resource('members', MemberController::class);

    // Loans
    Route::resource('loans', LoanController::class);
    Route::post('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');
    Route::post('/loans/{loan}/overdue', [LoanController::class, 'markOverdue'])->name('loans.overdue');

    // Fines
    Route::resource('fines', FineController::class);
    Route::post('/fines/{fine}/pay', [FineController::class, 'pay'])->name('fines.pay');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/books', [ReportController::class, 'generateBookReport'])->name('reports.books');
    Route::get('/reports/loans', [ReportController::class, 'generateLoanReport'])->name('reports.loans');
    Route::get('/reports/members', [ReportController::class, 'generateMemberReport'])->name('reports.members');
    Route::get('/reports/fines', [ReportController::class, 'generateFineReport'])->name('reports.fines');
});
