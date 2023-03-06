<?php

use App\Http\Controllers\back\CategorieController;
use App\Http\Controllers\back\ChantController;
use App\Http\Controllers\back\DailyController;
use App\Http\Controllers\back\PrayController;
use App\Http\Controllers\back\SettingController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controller::class, 'index']);



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('kategoriler', CategorieController::class);
    Route::resource('dualar', PrayController::class);
    Route::resource('zikirler', ChantController::class);
    Route::resource('gunluk', DailyController::class);
    Route::resource('ayarlar', SettingController::class);
});

require __DIR__ . '/auth.php';
