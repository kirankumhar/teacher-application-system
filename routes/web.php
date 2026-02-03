<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Applicant\PaymentController;
use App\Http\Controllers\Applicant\RegistrationController;
use App\Http\Controllers\Applicant\DashboardController as ApplicantDashboard;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::get('/applicants', [ApplicantController::class, 'index'])->name('admin.applicants.index');
});

Route::middleware(['auth','role:applicant'])->prefix('applicant')->group(function () {
    Route::get('/dashboard', [ApplicantDashboard::class, 'index'])
        ->name('applicant.dashboard');
});

Route::get('/applicant/register', [RegistrationController::class, 'create'])->name('applicant.register');
Route::post('/applicant/register', [RegistrationController::class, 'store'])->name('applicant.register.store');

Route::middleware(['auth'])->prefix('applicant')->group(function () {
    Route::get('/application/step-1', [PaymentController::class, 'create'])->name('applicant.payment.step1');
});