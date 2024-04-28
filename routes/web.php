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
use App\Http\Controllers\PricingController;
use App\Http\Controllers\DashboardController;
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


Route::get('/countries', 'CountryStateController@getCountries');
Route::get('/states/{countryIso}', 'CountryStateController@getStates');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users/make-agent', [AgentController::class, 'makeAgent'])->name('makeAgent');

    Route::prefix('puk')->group(function () {
        Route::get('/', [PUKController::class, 'index'])->name('puk');
        Route::post('/submit', [PUKController::class, 'store'])->name('submit.puk');
        Route::get('/{pukTransactionId}', [PUKController::class, 'view'])->name('view.puk');
        Route::put('/{pukTransactionId}', [PUKController::class, 'update'])->name('update.puk');
    });

    Route::get('/tracks', [TracksController::class, 'index'])->name('tracks');
    Route::get('/tracks/{transactionId}', [TracksController::class, 'view'])->name('view.transaction');
    
    Route::prefix('nin')->group(function () {
        Route::prefix('validation')->group(function () {
            Route::get('/', [ValidationController::class, 'index'])->name('validation');
            Route::post('/submit', [ValidationController::class, 'store'])->name('submit.validation');
            Route::get('/{validationId}', [ValidationController::class, 'view'])->name('view.validation');
            Route::put('/{validationId}', [ValidationController::class, 'update'])->name('update.validation');
        });

        Route::prefix('ipe-clearance')->group(function () {
            Route::get('/', [IPEClearanceController::class, 'index'])->name('ipe-clearance');
            Route::post('/submit', [IPEClearanceController::class, 'store'])->name('submit.ipe-clearance');
            Route::get('/{ipeId}', [IPEClearanceController::class, 'view'])->name('view.ipe-clearance');
            Route::put('/{ipeId}', [IPEClearanceController::class, 'update'])->name('update.ipe-clearance');
        });

        Route::prefix('new-enrollment')->group(function () {
            Route::get('/', [NewEnrollmentController::class, 'index'])->name('new-enrollment');
            Route::post('/submit', [NewEnrollmentController::class, 'store'])->name('submit.new-enrollment');
            Route::get('/{enrollmentId}', [NewEnrollmentController::class, 'view'])->name('view.new-enrollment');
            Route::put('/{enrollmentId}', [NewEnrollmentController::class, 'update'])->name('update.new-enrollment');
        });

        Route::prefix('verification')->group(function () {
            Route::get('/', [VerificationController::class, 'index'])->name('verification');
            Route::post('/submit', [VerificationController::class, 'store'])->name('submit.verification');
            Route::get('/{verificationId}', [VerificationController::class, 'view'])->name('view.verification');
            Route::put('/{verificationId}', [VerificationController::class, 'update'])->name('update.verification');
        });

        Route::prefix('personalization')->group(function (){
            Route::get('/', [PersonalizationController::class, 'index'])->name('personalization');
            Route::post('/submit', [PersonalizationController::class, 'store'])->name('submit.personalization');
            Route::get('/{personalizationId}', [PersonalizationController::class, 'view'])->name('view.personalization');
            Route::put('/{personalizationId}', [PersonalizationController::class, 'update'])->name('update.personalization');   
        });

        Route::prefix('modification')->group(function (){
            Route::get('/', [ModificationController::class, 'index'])->name('modification');
            Route::post('/submit', [ModificationController::class, 'store'])->name('submit.modification');
            Route::get('/{modificationId}', [ModificationController::class, 'view'])->name('view.modification');
            Route::put('/{modificationId}', [ModificationController::class, 'update'])->name('update.modification');
        });
    });

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

        Route::prefix('pricing')->group(function () {
            Route::get('/', [PricingController::class, 'index'])->name('admin.pricing');
            Route::post('/', [PricingController::class, 'store'])->name('submit.pricing');
            Route::put('/{pricingId}', [PricingController::class, 'update'])->name('update.pricing');
            Route::delete('/{pricingId}', [PricingController::class, 'destroy'])->name('destroy.pricing');
        });
        
        Route::get('/puk', [AdminController::class, 'puk'])->name('admin.puk');
        Route::prefix('nin')->group(function () {
            Route::get('/verification', [AdminController::class, 'verification'])->name('admin.verification');
            Route::get('/validation', [AdminController::class, 'validation'])->name('admin.validation');
            Route::get('/ipe-clearance', [AdminController::class, 'ipeClearance'])->name('admin.ipe-clearance');
            Route::get('/new-enrollment', [AdminController::class, 'newEnrollment'])->name('admin.new-enrollment');

            Route::prefix('modification')->group(function () {  
                Route::get('/', [AdminController::class, 'modification'])->name('admin.modification');
            });

            Route::prefix('personalization')->group(function () {   
                Route::get('/', [AdminController::class, 'personalization'])->name('admin.personalization');
            });
        });
    });
});

require __DIR__.'/auth.php';
