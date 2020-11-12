<?php

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

// namespace da usare per mappare verso un metodo di una classe
use App\Http\Controllers\{HomeController, WelcomeController};

/*Route::get('/', function () {
    return view('welcome');
});*/

// mappatura di una rotta e richiamo di un metodo di una classe
Route::get('/', [HomeController::class, 'index']);

Route::get('/{name?}/{lastname?}/{age?}', [WelcomeController::class, 'welcome'])->where([
    'name' => '[a-zA-Z]+',
    'lastname' => '[a-zA-Z]+',
    'age' => '[0-9]{0,3}',
]);

// è possibile tornare qualsiasi tipo di dato da una rotta
Route::get('/users', function () {

    $users = [];
    foreach(range(0, 10) as $v){
        $user = new stdClass();
        $user->name = "Nunzio" . $v;
        $users[] = $user;
    }

    return $users;
});
