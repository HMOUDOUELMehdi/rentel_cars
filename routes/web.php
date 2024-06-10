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

 // Login and Register and log Out
Route::get('/register', 'App\Http\Controllers\AuthController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('register.submit');
Route::post('/addClient', 'App\Http\Controllers\AuthController@addClient')->name('addClient');
Route::get('/login', 'App\Http\Controllers\AuthController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login.submit');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

// Dashboard for admin

Route::get('/users', 'App\Http\Controllers\DashboardController@fetchAllUsers')->name('users');
Route::delete('/users/{id}', 'App\Http\Controllers\DashboardController@destroyUsers')->name('users.destroy');
Route::get('/dashboard', function () {
    return view('dashboard.layout');
});
Route::get('/clientCreate', function () {
    return view('dashboard.createClient');
})->name('client.create');
Route::resource('cars','App\Http\Controllers\CarController');
Route::get('cars/{id}/photos', 'App\Http\Controllers\CarController@addPhotos')->name('addPhotos');
Route::post('cars/{id}/photos', 'App\Http\Controllers\CarController@storePhotos')->name('storePhotos');
Route::delete('car_photos/{id}', 'App\Http\Controllers\CarController@destroyPhotos')->name('car_photos.destroy');


// Home Page For Client

Route::get('/', 'App\Http\Controllers\HomeController@homePage')->name('homePage');
Route::get('/{id}', 'App\Http\Controllers\CarController@show')->name('show');

