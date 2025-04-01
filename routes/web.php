<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::name('auth.')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::name('login')->get('/login', App\Http\Pages\Auth\Login::class);
        Route::name('register')->get('/signup', App\Http\Pages\Auth\Register::class);
    });
    Route::name('logout')->middleware(['auth'])->get('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect(route('auth.login'));
    });
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::name('dashboard')->prefix('/dashboard')->group(function () {
        Route::name('.index')->get('/', App\Http\Pages\Dashboard\Index::class);
    });
    // Loads
    Route::name('loads')->prefix('/loads')->group(function () {
        Route::get('/', App\Http\Pages\Loads\Index::class);
    });
});
