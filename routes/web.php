<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index'])->name('home');
Route::post('checkout', [IndexController::class, 'checkout'])->name('checkout');
Route::get('success/{order}', [IndexController::class, 'success'])->name('success');
Route::get('scan', function () {
    return view('front.scan');
});

Route::get('ticket/{order}', [IndexController::class, 'ticket'])->name('ticket');
