<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AccessLinkController;
use App\Http\Controllers\LuckyGameController;


Route::get('/', function () {
    return Inertia::render('Register');
})->name('home');

// Register
Route::post('/register', [RegisterController::class, 'store'])->name('register');

// Access
Route::get('/access/{token}', [AccessLinkController::class, 'show'])->name('access.show');
Route::patch('/access/{token}', [AccessLinkController::class, 'regenerate'])->name('access.regenerate');
Route::delete('/access/{token}', [AccessLinkController::class, 'deactivate'])->name('access.deactivate');

// Lucky-game
Route::post('/lucky-game', [LuckyGameController::class, 'play'])->name('lucky-game.play');
Route::get('/lucky-game/history/{token}', [LuckyGameController::class, 'history'])->name('lucky-game.history');

