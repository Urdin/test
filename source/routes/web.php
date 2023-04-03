<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



//Route::any('/checkout/cart', 'CartController@index')->name('checkout.cart');

/*
Route::get('/ads', function () {
    return view('ads');
});
*/

//Route::post('/ads/{id}', 'App\Http\Controllers\AdsController@index')->where('id', '.*')->name('ads.all');
//Route::get('/ads/new', 'App\Http\Controllers\AdsController@index')->name('ads.view');




Route::post('/ads/new', 'App\Http\Controllers\AdsController@new')->middleware('auth')->name('ads.new');
Route::post('/ads/update', 'App\Http\Controllers\AdsController@update')->middleware('auth')->name('ads.update');
Route::get('/ads/delete/{id}', 'App\Http\Controllers\AdsController@delete')->where('id', '.*')->middleware('auth')->name('ads.delete');

Route::get('/ads/{id}', 'App\Http\Controllers\AdsController@index')->where('id', '.*')->middleware('auth')->name('ads');


