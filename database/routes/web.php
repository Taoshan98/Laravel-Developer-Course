<?php

use App\Models\{Album, Photo, User};
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {
    echo "<pre>";
    return print_r(User::with('albums')->paginate(5));
});

Route::get('/albums', function () {
    echo "<pre>";
    return print_r(Album::with('photo')->paginate(5));
});

Route::get('/photo', function () {
    echo "<pre>";
    return print_r(Photo::get());
});
