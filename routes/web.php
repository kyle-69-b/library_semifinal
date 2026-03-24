<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Member\MemberDashboardController;

// ── Public routes ──────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ── Admin Auth ─────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ── Member Auth (no guest middleware — causes redirect issues) ──
Route::get('/member/login',  [MemberAuthController::class, 'showLoginForm'])->name('member.login');
Route::post('/member/login', [MemberAuthController::class, 'login'])->name('member.login.submit');
Route::post('/member/logout', [MemberAuthController::class, 'logout'])
    ->name('member.logout')
    ->middleware('auth:member');

// ── Admin Protected Routes ─────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('books',      BookController::class);
    Route::resource('members',    MemberController::class);

    Route::resource('loans', LoanController::class);
    Route::post('/loans/{loan}/return',  [LoanController::class, 'returnBook'])->name('loans.return');
    Route::post('/loans/{loan}/overdue', [LoanController::class, 'markOverdue'])->name('loans.overdue');

    Route::resource('fines', FineController::class);
    Route::post('/fines/{fine}/pay', [FineController::class, 'pay'])->name('fines.pay');

    Route::get('/reports',         [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/books',   [ReportController::class, 'generateBookReport'])->name('reports.books');
    Route::get('/reports/loans',   [ReportController::class, 'generateLoanReport'])->name('reports.loans');
    Route::get('/reports/members', [ReportController::class, 'generateMemberReport'])->name('reports.members');
    Route::get('/reports/fines',   [ReportController::class, 'generateFineReport'])->name('reports.fines');
});

// ── Member Protected Routes ────────────────────────────
Route::middleware(['auth:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
    Route::get('/loans',     [MemberDashboardController::class, 'loans'])->name('loans');
    Route::get('/history',   [MemberDashboardController::class, 'history'])->name('history');
    Route::get('/fines',     [MemberDashboardController::class, 'fines'])->name('fines');
});
