<?php

use Illuminate\Routing\RouteUrlGenerator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', 'MovieController@index')->name('movies.index');

Route::get('/', [MovieController::class, 'index']);

Route::get('/movies.show/{id}', [MovieController::class, 'show']);


// Route::get('/', 'MoviesController@index')->name('movies.index');
// Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');