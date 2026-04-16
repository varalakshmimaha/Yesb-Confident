<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnquiryController;
use Illuminate\Support\Facades\Route;

// Main Website
Route::get('/', function () {
    return view('home');
})->name('home');

// Enquiry Form Submission
Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.authenticate');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::patch('/enquiry/{enquiry}/status', [AdminController::class, 'updateStatus'])->name('admin.enquiry.status');
    Route::delete('/enquiry/{enquiry}', [AdminController::class, 'destroy'])->name('admin.enquiry.destroy');
    Route::delete('/enquiries/all', [AdminController::class, 'destroyAll'])->name('admin.enquiry.destroyAll');
    Route::get('/export-csv', [AdminController::class, 'exportCsv'])->name('admin.export');
});
