<?php

use App\Http\Controllers\api\PeopleController;
use App\Http\Controllers\api\ViewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api', 'checktoken')->group(function () {
    Route::post('people', [PeopleController::class, 'store']);
    Route::get('categories', [ViewController::class, 'categories']);
    Route::get('prays', [ViewController::class, 'prays']);
    Route::get('chants', [ViewController::class, 'chants']);
    Route::get('daily', [ViewController::class, 'daily']);
    Route::get('setting', [ViewController::class, 'setting']);
});
