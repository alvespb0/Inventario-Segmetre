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

Route::get('/', function () {
    return view('index');
});

// Setores (telas estáticas enquanto o backend é confeccionado)
Route::view('/setores', 'setores.index')->name('setores.index');
Route::view('/setores/novo', 'setores.create')->name('setores.create');
