<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;


// Route::get('/', [IndexController::class, 'index'])->name('home');
// Route::post('checkout', [IndexController::class, 'checkout'])->name('checkout');
// Route::get('success/{order}', [IndexController::class, 'success'])->name('success');
Route::get('ticket/{order}', [IndexController::class, 'ticket'])->name('ticket');
Route::get('scan/{gate}', [IndexController::class, 'scan'])->name('gate');
Route::get('scanner/{gate}', [IndexController::class, 'scanner'])->name('scanner');
Route::get('/invoice/{order}/download', [IndexController::class, 'download'])
    ->name('invoice.download')
    ->middleware(['auth']);
