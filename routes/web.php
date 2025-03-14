<?php

use App\Http\Controllers\RedisBitMapController;
use Illuminate\Support\Facades\Route;

/**
 * ot real user, just in-memory user,
 * it'll help to by-pass auth for private channel broadcasting.
 */
\Illuminate\Support\Facades\Auth::login(new \App\Models\User());

Route::get('/', \App\Http\Controllers\HomeController::class);

Route::get('/redis/bitmap/get', [RedisBitMapController::class, 'bitmap'])->name('bitmap');
