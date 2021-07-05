<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Models\Restaurant;

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

// Restaurants
Route::get('/', [RestaurantController::class, 'index'])
    ->name('restaurant.index');
Route::get('/register', [RestaurantController::class, 'create'])
    ->name('restaurant.create');
Route::post('/register', [RestaurantController::class, 'store'])
    ->name('restaurant.store');
Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show'])
    ->name('restaurant.show');
Route::get('restaurant/{restaurant}/edit', [RestaurantController::class, 'edit'])
    ->name('restaurant.edit');
Route::put('restaurant/{restaurant}/edit', [RestaurantController::class, 'update'])
    ->name('restaurant.update');
Route::get('/restaurant/{restaurant}/reservations', [RestaurantController::class, 'reserve'])
    ->name('restaurant.reserve');

// Reservations
Route::resource('reservations', ReservationController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
