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

function createLocaleStripper($method) {
    return function($locale, Restaurant $restaurant) use ($method) {
        $controller = app()->make(RestaurantController::class);
        return app()->call([$controller, $method], compact('restaurant'));
    };
}

Route::redirect('/', '/home/en');

Route::group([
    'prefix' => '/home/{locale}',
    'middleware' => 'lang',
], function ($restaurant) {
    Route::get('/', [RestaurantController::class, 'index'])
        ->name('restaurant.index');

    Route::resource('restaurant', RestaurantController::class)
        ->only(['show', 'edit', 'update']);
});

Route::get('business/dashboard', function () {
    App::setLocale(Auth::user()->locale);
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::put('business/dashboard', LocaleChangeController::class)
    ->middleware('auth')->name('change-locale');

Route::group([
    'prefix' => '/business/{locale}',
    'middleware' => 'lang',
], function () {
    Route::get('/', function () {
        return view('business-home');
    });

    Route::get('/register', [RestaurantController::class, 'create'])
        ->name('restaurant.create');

    Route::post('/register', [RestaurantController::class, 'store'])
        ->name('restaurant.store');

    require __DIR__.'/auth.php';
});
