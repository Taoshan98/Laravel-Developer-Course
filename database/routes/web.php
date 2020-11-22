<?php

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

use App\Models\{Photo, User};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
  AlbumsController
};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {
    echo "<pre>";
    return print_r(User::with('albums')->paginate(5));
});

Route::resource('/albums', AlbumsController::class);

Route::get('/usersnoalbums', function () {
   $usersNoAlbum = DB::table('users as u')
       ->select("u.id", "email", "name")
       ->leftJoin('albums as a', 'u.id', 'a.user_id')
       ->whereNull('album_name')
       ->get();

   return $usersNoAlbum;
});

Route::get('/photo', function () {
    echo "<pre>";
    return print_r(Photo::get());
});
