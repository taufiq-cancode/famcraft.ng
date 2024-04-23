<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PUKController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\TracksController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\IPEClearanceController;
use App\Http\Controllers\PersonalizationController;
use App\Http\Controllers\NewEnrollmentController;
use App\Http\Controllers\ModificationController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buy-airtime', function () {
    return view('airtime');
})->name('airtime');

Route::get('/buy-data', function () {
    return view('data');
})->name('data');

Route::get('/cable-tv', function () {
    return view('cable-tv');
})->name('cable-tv');

Route::get('/airtime-cash', function () {
    return view('airtime-cash');
})->name('airtime-cash');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/history', function () {
    return view('history');
})->name('history');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/puk', [PUKController::class, 'index'])->name('puk');
    Route::post('puk/submit', [PUKController::class, 'store'])->name('submit.puk');
    Route::get('puk/{pukTransactionId}', [PUKController::class, 'view'])->name('view.puk');
    Route::put('puk/{pukTransactionId}', [PUKController::class, 'update'])->name('update.puk');

    Route::get('/tracks', [TracksController::class, 'index'])->name('tracks');

    
    Route::prefix('nin')->group(function () {
        Route::get('/validation', [ValidationController::class, 'index'])->name('validation');
        Route::post('/validation/submit', [ValidationController::class, 'store'])->name('submit.validation');
        Route::get('/validation/{validationId}', [ValidationController::class, 'view'])->name('view.validation');
        Route::put('/validation/{validationId}', [ValidationController::class, 'update'])->name('update.validation');

        Route::get('/ipe-clearance', [IPEClearanceController::class, 'index'])->name('ipe-clearance');
        Route::post('/ipe-clearance/submit', [IPEClearanceController::class, 'store'])->name('submit.ipe-clearance');
        Route::get('/ipe-clearance/{ipeId}', [IPEClearanceController::class, 'view'])->name('view.ipe-clearance');
        Route::put('/ipe-clearance/{ipeId}', [IPEClearanceController::class, 'update'])->name('update.ipe-clearance');

        Route::get('/personalization', [PersonalizationController::class, 'index'])->name('personalization');
        Route::post('/personalization/submit', [PersonalizationController::class, 'store'])->name('submit.personalization');

        Route::get('/new-enrollment', [NewEnrollmentController::class, 'index'])->name('new-enrollment');
        Route::post('/new-enrollment/submit', [NewEnrollmentController::class, 'store'])->name('submit.new-enrollment');
        Route::get('/new-enrollment/{enrollmentId}', [NewEnrollmentController::class, 'view'])->name('view.new-enrollment');
        Route::put('/new-enrollment/{enrollmentId}', [NewEnrollmentController::class, 'update'])->name('update.new-enrollment');

        Route::get('/modification', [ModificationController::class, 'index'])->name('modification');
        Route::post('/modification/submit', [ModificationController::class, 'store'])->name('submit.modification');

        Route::get('/verification', [VerificationController::class, 'index'])->name('verification');
        Route::post('/verification/submit', [VerificationController::class, 'store'])->name('submit.verification');
        Route::get('/verification/{verificationId}', [VerificationController::class, 'view'])->name('view.verification');
        Route::put('/verification/{verificationId}', [VerificationController::class, 'update'])->name('update.verification');
    });

    Route::get('/users/make-agent', [AgentController::class, 'makeAgent'])->name('makeAgent');

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/puk', [AdminController::class, 'puk'])->name('admin.puk');

        Route::prefix('nin')->group(function () {
            Route::get('/verification', [AdminController::class, 'verification'])->name('admin.verification');
            Route::get('/validation', [AdminController::class, 'validation'])->name('admin.validation');
            Route::get('/ipe-clearance', [AdminController::class, 'ipeClearance'])->name('admin.ipe-clearance');
            Route::get('/new-enrollment', [AdminController::class, 'newEnrollment'])->name('admin.new-enrollment');

            Route::prefix('modification')->group(function () {  
                Route::get('/', [AdminController::class, 'modification'])->name('admin.modification');
                Route::get('/{modificationId}', [ModificationController::class, 'view'])->name('view.modification');
                Route::put('/{modificationId}', [ModificationController::class, 'update'])->name('update.modification');
            });
            
            Route::prefix('personalization')->group(function () {   
                Route::get('/', [AdminController::class, 'personalization'])->name('admin.personalization');
                Route::get('/{personalizationId}', [PersonalizationController::class, 'view'])->name('view.personalization');
                Route::put('/{personalizationId}', [PersonalizationController::class, 'update'])->name('update.personalization');   
            });

            Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        });
    });
});

require __DIR__.'/auth.php';
