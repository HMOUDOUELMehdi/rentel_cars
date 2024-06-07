<?php

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

Route::get('/register', 'App\Http\Controllers\AuthController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('register.submit');

Route::get('/login', 'App\Http\Controllers\AuthController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login.submit');

Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::get('/users', 'App\Http\Controllers\DashboardController@fetchAllUsers')->name('users');
Route::delete('/users/{id}', 'App\Http\Controllers\DashboardController@destroyUsers')->name('users.destroy');

Route::get('/', function () {
    return view('dashboard.layout');
});

Route::resource('cars','App\Http\Controllers\CarController');

Route::get('cars/{id}/photos', 'App\Http\Controllers\CarController@addPhotos')->name('addPhotos');
Route::post('cars/{id}/photos', 'App\Http\Controllers\CarController@storePhotos')->name('storePhotos');


Route::delete('car_photos/{id}', 'App\Http\Controllers\CarController@destroyPhotos')->name('car_photos.destroy');
