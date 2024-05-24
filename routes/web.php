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
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SlipController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/payment-cancelled', function () {
    return view('payment-cancelled');
});

Route::get('/slip', function () {
    return view('slip.test');
});

Route::prefix('bills')->group(function () {
    
    Route::get('/buy-airtime', function () {
        return view('airtime');
    })->name('airtime');

    Route::get('/buy-data', function () {
        return view('data');
    })->name('data');

    Route::get('/cable-tv', function () {
        return view('cable-tv');
    })->name('cable-tv');

    // Route::get('/airtime-cash', function () {
    //     return view('airtime-cash');
    // })->name('airtime-cash');

    Route::get('/electricity-payment', function () {
        return view('airtime-cash');
    })->name('electricity-payment');

    Route::get('/result-pin', function () {
        return view('airtime-cash');
    })->name('result-pin');

});

Route::get('/slip/premium', [SlipController::class, 'premium'])->name('slip.premium');
Route::get('/slip/standard', [SlipController::class, 'standard'])->name('slip.standard');
Route::get('/slip/improved', [SlipController::class, 'improved'])->name('slip.improved');
Route::get('/slip/basic', [SlipController::class, 'basic'])->name('slip.basic');
Route::get('/slip/nvs', [SlipController::class, 'nvs'])->name('slip.nvs');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/countries', 'CountryStateController@getCountries');
Route::get('/states/{countryIso}', 'CountryStateController@getStates');
Route::get('/download/{filename}', [FileController::class, 'download'])->name('file.download');
Route::get('/slip-download/{filename}', [FileController::class, 'slipDownload'])->name('slip.download');

// Route::get('/slip-premium', [SlipController::class, , 'premium'])->name('slip.premium');


Route::middleware(['auth'])->group(function () {

    Route::get('/verification-response', function () {
        $slipData = Session::get('slipData');
        $verificationData = session('verificationData');
        $imagePath = session('imagePath');
    
        if (!$slipData) {
            return back()->with('error', 'No verification data found.');
        }
    
        return view('verification-response', compact('slipData', 'verificationData', 'imagePath'));
    })->name('verification.response');

    Route::post('/search', [SearchController::class, 'index'])->name('search');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/agent-access', [PaymentController::class, 'initializeTransaction'])->name('initializeTransaction');

    Route::post('/payment-status', [PaymentController::class, 'handlePaymentCallback'])->name('payment.callback');
    
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/wallet', [PaymentController::class, 'index'])->name('wallet');
    Route::get('/tracks', [TracksController::class, 'index'])->name('tracks');
    Route::get('/notification/{notificationId}', [NotificationController::class, 'view'])->name('view.notification');

    Route::prefix('puk')->group(function () {
        Route::get('/', [PUKController::class, 'index'])->name('puk');
        Route::post('/submit', [PUKController::class, 'store'])->name('submit.puk');
        Route::get('/{pukTransactionId}', [PUKController::class, 'view'])->name('view.puk');
        Route::put('/{pukTransactionId}', [PUKController::class, 'update'])->name('update.puk');
    });
    
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

        Route::get('/{notificationId}', [NotificationController::class, 'view'])->name('view.notification');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

        //VIEW PAYMENT
        Route::get('/payment/{paymentId}', [PaymentController::class, 'view'])->name('view.payment');
        Route::put('/payment/{paymentId}', [PaymentController::class, 'update'])->name('update.payment');

        Route::prefix('pricing')->group(function () {
            Route::get('/', [PricingController::class, 'index'])->name('admin.pricing');
            Route::post('/', [PricingController::class, 'store'])->name('submit.pricing');
            Route::put('/{pricingId}', [PricingController::class, 'update'])->name('update.pricing');
            Route::delete('/{pricingId}', [PricingController::class, 'destroy'])->name('destroy.pricing');
        });

        Route::prefix('notification')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('admin.notification');
            Route::post('/', [NotificationController::class, 'store'])->name('submit.notification');
            Route::put('/{notificationId}', [NotificationController::class, 'update'])->name('update.notification');
            Route::delete('/{notificationId}', [NotificationController::class, 'destroy'])->name('delete.notification');
        });
        
        Route::prefix('agent')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('admin.users');
            Route::post('/', [UsersController::class, 'store'])->name('submit.user');
            Route::get('/{userId}', [UsersController::class, 'view'])->name('view.user');
            Route::put('/{userId}', [UsersController::class, 'update'])->name('update.user');
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
