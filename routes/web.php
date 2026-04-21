<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('success', function () {
    return view('front.success');
});
Route::get('scan', function () {
    return view('front.scan');
});
