<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetorController;

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


Route::controller(SetorController::class)->group(function(){
    Route::get('/setores', 'readSetor')->name('setores.show');
    Route::get('/setores/novo', 'cadastroSetor')->name('setores.new');
    Route::post('/setores/novo', 'createSetor')->name('setores.create');
    Route::get('/setores/editar/{id}', 'editarSetor')->name('setores.edit');
    Route::post('/setores/editar', 'updateSetor')->name('setores.update');
    Route::post('/setores/excluir', 'deleteSetor')->name('setores.delete');

});