<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/puk', function () {
    return view('puk');
})->name('puk');

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


// Route::get('/verification', function () {
//     return view('airtime');
// })->name('airtime');

// Route::get('/buy-airtime', function () {
//     return view('airtime');
// })->name('airtime');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   
});

require __DIR__.'/auth.php';
