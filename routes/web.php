<?php

use Illuminate\Support\Facades\Route;

Route::get('{any}', function() {
    return view('app');
})->where('any', '.*');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
