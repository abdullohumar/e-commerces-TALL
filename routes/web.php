<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Volt::route('/login', 'auth.⚡login')->name('login')->middleware('guest');
Volt::route('/register', 'auth.⚡register')->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');    
});