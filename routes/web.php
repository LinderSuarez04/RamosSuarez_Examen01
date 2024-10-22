<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InfraccionController;


//categoria/create
// php artisan route:list
Route::resource('infraccion', InfraccionController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/infraccion', function () {
    return view('infraccion.index');
});

