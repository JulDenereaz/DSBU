<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// use App\Filament\Pages\Auth\Register;

// Route::get('/dashboard/register', Register::class)
//     ->name('filament.auth.register');

