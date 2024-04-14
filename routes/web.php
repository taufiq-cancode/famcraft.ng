<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PUKController;
use App\Http\Controllers\AgentController;
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

Route::prefix('nin')->group(function () {

    Route::get('/verification', function () {
        return view('verification');
    })->name('verification');

    Route::get('/validation', function () {
        return view('validation');
    })->name('validation');

    Route::get('/ipe-clearance', function () {
        return view('ipe-clearance');
    })->name('ipe-clearance');

    Route::get('/new-enrollment', function () {
        return view('new-enrollment');
    })->name('new-enrollment');

    Route::get('/modification', function () {
        return view('modification');
    })->name('modification');

    Route::get('/personalization', function () {
        return view('personalization');
    })->name('personalization');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {

    Route::get('/puk', [PUKController::class, 'index'])->name('puk');
    Route::post('puk/submit', [PUKController::class, 'store'])->name('submit.puk');
    Route::get('puk/{pukTransactionId}', [PUKController::class, 'view'])->name('view.puk');
    Route::put('puk/{pukTransactionId}', [PUKController::class, 'update'])->name('update.puk');



    Route::get('/users/make-agent', [AgentController::class, 'makeAgent'])->name('makeAgent');

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/puk', [AdminController::class, 'puk'])->name('admin.puk');

        Route::prefix('nin')->group(function () {
            Route::get('/verification', [AdminController::class, 'verification'])->name('admin.verification');
            Route::get('/validation', [AdminController::class, 'validation'])->name('admin.validation');
            Route::get('/ipe-clearance', [AdminController::class, 'ipeClearance'])->name('admin.ipe-clearance');
            Route::get('/new-enrollment', [AdminController::class, 'newEnrollment'])->name('admin.new-enrollment');
            Route::get('/modification', [AdminController::class, 'modification'])->name('admin.modification');
            Route::get('/personalization', [AdminController::class, 'personalization'])->name('admin.personalization');
            Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        });
    });
});


Route::middleware('auth')->group(function () {
   
});

require __DIR__.'/auth.php';
