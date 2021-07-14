<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\LocaleChangeController;

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

Route::redirect('/', '/home/en');

Route::group([
    'prefix' => '/home/{locale}',
], function ($restaurant) {
    Route::get('/', [RestaurantController::class, 'index'])
        ->name('restaurant.index');

    Route::resource('restaurant', RestaurantController::class)
        ->only(['show', 'edit', 'update']);
});

Route::group([
    'prefix' => '/business/dashboard',
    'middleware' => 'auth',
], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::put('/', LocaleChangeController::class)->name('change-locale');

    require __DIR__.'/user-auth.php';
});

Route::group([
    'prefix' => '/business/{locale}',
], function () {
    Route::get('/', function () {
        return view('business-home');
    });

    Route::get('/register', [RestaurantController::class, 'create'])
        ->name('restaurant.create');

    Route::post('/register', [RestaurantController::class, 'store'])
        ->name('restaurant.store');

    require __DIR__.'/guest-auth.php';
});
