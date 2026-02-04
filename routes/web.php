<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Applicant\PaymentController;
use App\Http\Controllers\Applicant\ApplicantStep2Controller;
use App\Http\Controllers\Applicant\ApplicantStep3Controller;
use App\Http\Controllers\Applicant\RegistrationController;
use App\Http\Controllers\Applicant\DashboardController as ApplicantDashboard;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('applicant.dashboard');
    }
    return view('home');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Breeze Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::get('/applicants', [ApplicantController::class, 'index'])->name('admin.applicants.index');
    Route::get('/applicants/submitted', [ApplicantController::class, 'submitted'])->name('admin.applicants.submitted');
    Route::get('/applicants/approved', [ApplicantController::class, 'approved'])->name('admin.applicants.approved');
    Route::get('/applicants/rejected', [ApplicantController::class, 'rejected'])->name('admin.applicants.rejected');
    Route::get('/applicants/{applicant}', [ApplicantController::class, 'show'])->name('admin.applicants.show');
    Route::post('/applicants/{applicant}/approve',[ApplicantController::class, 'approve'])->name('admin.applicants.approve');
    Route::post('/applicants/{applicant}/reject', [ApplicantController::class, 'reject'])->name('admin.applicants.reject');
    
});

Route::middleware(['auth','role:applicant'])->prefix('applicant')->group(function () {
    Route::get('/dashboard', [ApplicantDashboard::class, 'index'])
        ->name('applicant.dashboard');
});

Route::get('/applicant/register', [RegistrationController::class, 'create'])->name('applicant.register');
Route::post('/applicant/register', [RegistrationController::class, 'store'])->name('applicant.register.store');

Route::middleware(['auth'])->prefix('applicant')->group(function () {
    Route::get('/application/step-1', [PaymentController::class, 'create'])->name('applicant.payment.step1');
    Route::post('/application/step-1', [PaymentController::class, 'store'])->name('applicant.payment.store');
    Route::get('/application/step-2', [ApplicantStep2Controller::class, 'create'])->name('applicant.step2');
    Route::post('/application/step-2/store', [ApplicantStep2Controller::class, 'store'])
        ->name('applicant.step2.store');    
    Route::get('/application/step-3', [ApplicantStep3Controller::class, 'create'])
        ->name('applicant.step3');
        Route::post('/application/step-3', [ApplicantStep3Controller::class, 'store'])
    ->name('applicant.step3.store');
    Route::get('/application/preview', [ApplicantStep3Controller::class, 'view'])->name('applicant.preview');
    Route::post('/application/final-submit', [ApplicantStep3Controller::class, 'finalSubmit'])->name('applicant.final.submit');
});

Route::middleware(['auth','role:admin'])->prefix('admin')->group(function () {

    

});
