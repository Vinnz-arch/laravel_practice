<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\MenController;
use App\Models\Men;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [MenController::class, 'index'])->name('dashboard');
Route::post('/mens', [MenController::class, 'store'])->name('mens.store');


Route::delete('/mens/{men}', [MenController::class, 'destroy'])->name('mens.destroy');
Route::put('/mens/{men}', [MenController::class, 'update'])->name('mens.update');
Route::get('/mens/{men}/edit', [MenController::class, 'edit'])->name('mens.edit');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
