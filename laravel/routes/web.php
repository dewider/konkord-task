<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api', [ApiController::class, 'putValue']);
Route::get('/api', [ApiController::class, 'getValues']);