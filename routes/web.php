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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/perfis', [App\Http\Controllers\RoleController::class, 'index'])->name('perfis');

    Route::get('/cadastros/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::post('/perfis/editar/{id}', [App\Http\Controllers\RoleController::class, 'update']);
});