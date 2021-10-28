<?php

use Illuminate\Support\Facades\Route;
use App\Models\users;
use App\Models\tasks;

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

Route::get('users/Login','usersController@LoginView');
Route::post('users/doLogin','usersController@login');
Route::get('users/LogOut','usersController@LogOut')->middleware('userCheck');
Route::resource('users', 'usersController');


Route::get('users/Login','usersController@LoginView');
Route::post('users/doLogin','usersController@login');
Route::get('users/LogOut','usersController@LogOut')->middleware('userCheck');
Route::resource('tasks', 'tasksController');
