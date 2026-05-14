<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('guest.dashboard');    
Volt::route('/login', 'auth.⚡login')->name('login')->middleware('guest');
Volt::route('/register', 'auth.⚡register')->name('register');

Route::middleware('auth')->group(function () {
    Volt::route('/admin', 'admin.⚡dashboard')->name('admin.dashboard');
    Volt::route('/admin/hero-banner', 'admin.⚡hero-banner')->name('admin.hero-banner');
    Volt::route('/admin/product-banner', 'admin.⚡product-banner')->name('admin.product-banner');
});