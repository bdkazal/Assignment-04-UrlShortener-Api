<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;

// Route::get('/', function () {
//     return view('welcome');
// });

/* Catch-all route for short URL redirection */

Route::get('/{short_code}', RedirectController::class);
