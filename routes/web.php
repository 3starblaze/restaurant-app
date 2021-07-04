<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

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

    Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show'])
        ->name('restaurant.show');

    Route::get('restaurant/{restaurant}/edit', [RestaurantController::class, 'edit'])
        ->name('restaurant.edit');

    Route::put('restaurant/{restaurant}/edit', [RestaurantController::class, 'update'])
        ->name('restaurant.update');
});

Route::get('/register', [RestaurantController::class, 'create'])
    ->name('restaurant.create');
Route::post('/register', [RestaurantController::class, 'store'])
    ->name('restaurant.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
