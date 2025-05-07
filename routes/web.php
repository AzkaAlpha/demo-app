<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Dashboard Route
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Users Routes
    Volt::route('user/index', 'user.index')->name('user');

    // Roles Routes
    Volt::route('rank/index', 'rank.index')->name('rank');

    // Divisions Routes
    Volt::route('division/index', 'division.index')->name('division');

    // Positions Routes
    Volt::route('position/index', 'position.index')->name('position');

    // Orders Routes
    Volt::route('order/index', 'order.index')->name('order');
    Volt::route('order/create', 'order.create')->name('order.create');
    Volt::route('order/{order}/edit', 'order.edit')->name('order.edit');
    Volt::route('order/{order}/delete', 'order.delete')->name('order.delete');
    Route::get('order/{order}/pdf', [App\Http\Controllers\OrderController::class, 'generatePDF'])->name('order.pdf');
    Route::get('order/verify/{order}', [App\Http\Controllers\OrderController::class, 'verifyOrder'])->name('order.verify');

    // Demands Routes
    Volt::route('demand/index', 'demand.index')->name('demand');
    Volt::route('demand/create', 'demand.create')->name('demand.create');
    Volt::route('demand/{demand}/edit', 'demand.edit')->name('demand.edit');
    Volt::route('demand/{demand}/delete', 'demand.delete')->name('demand.delete');
    Route::get('demand/{demand}/pdf', [App\Http\Controllers\DemandController::class, 'generatePDF'])->name('demand.pdf');
    Route::get('demand/verify/{demand}', [App\Http\Controllers\DemandController::class,'verifyDemand'])->name('demand.verify');




    // Positions Routes
    Volt::route('vendor/index', 'vendor.index')->name('vendor');

});

require __DIR__.'/auth.php';
