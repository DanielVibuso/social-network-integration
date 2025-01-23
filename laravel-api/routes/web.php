<?php

use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirectToProvider']);

Route::get('/', function () {
    return view('welcome');
});
