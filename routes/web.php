<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ThankyouController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

});

Route::middleware('auth')->group(function () {
  Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
  Route::controller(ContactController::class)->group(function() {
    Route::get('/', 'index')->name('contacts.index');
    Route::get('/add', 'create')->name('contacts.add');
    Route::post('/store', 'store')->name('contacts.store');
    Route::get('/edit/{id}', 'edit')->name('contacts.edit');
    Route::put('/update/{id}', 'update')->name('contacts.update');
    Route::delete('/delete/{id}', 'destroy')->name('contacts.destroy');
    Route::get('/ajaxResult', 'ajaxResult')->name('contacts.ajaxResult');
  });

  Route::controller(ThankyouController::class)->group(function() {
    Route::get('/thank-you', 'index')->name('thank_you.index');
    Route::get('/proceed', 'proceed')->name('thank_you.proceed');
  });

});
