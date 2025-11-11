<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemSetorController;
use App\Http\Controllers\SolicitacaoItemController;

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

/** --------------------------------------------- */
/**         Rotas Classe Setor Controller         */
Route::middleware(['auth','admin'])->controller(SetorController::class)->group(function(){
    Route::get('/setores', 'readSetor')->name('setores.show');
    Route::get('/setores/novo', 'cadastroSetor')->name('setores.new');
    Route::post('/setores/novo', 'createSetor')->name('setores.create');
    Route::get('/setores/editar/{id}', 'editarSetor')->name('setores.edit');
    Route::post('/setores/editar', 'updateSetor')->name('setores.update');
    Route::post('/setores/excluir', 'deleteSetor')->name('setores.delete');

});

/** --------------------------------------------- */
/**         Rotas Classe User Controller          */
Route::middleware(['auth','admin'])->controller(UserController::class)->group(function(){
    Route::get('/usuarios', 'readUsuarios')->name('usuarios.show');
    Route::get('/usuarios/novo', 'cadastroUsuario')->name('usuarios.new');
    Route::post('/usuarios/novo', 'createUsuario')->name('usuarios.create');
    Route::get('/usuarios/editar/{id}', 'editarUsuario')->name('usuarios.edit');
    Route::post('/usuarios/editar/{id}', 'updateUsuario')->name('usuarios.update');
    Route::get('/usuarios/excluir/{id}', 'deleteUsuario')->name('usuarios.delete');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'login')->name('login.show');
    Route::post('/login', 'tryLogin')->name('try.login');
    Route::get('/logout', 'logout')->name('logout');
});

/** --------------------------------------------- */
/**       Rotas Classe FornecedorController       */
Route::middleware(['auth', 'admin'])->controller(FornecedorController::class)->group(function(){
    Route::get('/fornecedores', 'readFornecedores')->name('fornecedores.show');
    Route::get('/fornecedores/novo', 'cadastroFornecedor')->name('fornecedores.new');
    Route::post('/fornecedores/novo', 'createFornecedor')->name('fornecedores.create');
    Route::get('/fornecedores/editar/{id}', 'editarFornecedor')->name('fornecedores.edit');
    Route::post('/fornecedores/editar/{id}', 'updateFornecedor')->name('fornecedores.update');
    Route::get('/fornecedores/excluir/{id}', 'deleteFornecedor')->name('fornecedor.delete');
});

/** --------------------------------------------- */
/**         Rotas Classe ItemController          */
Route::middleware(['auth'])->controller(ItemController::class)->group(function(){
    Route::get('/itens', 'readItens')->name('itens.show');
    Route::get('/itens/filtro', 'filterItens')->name('itens.filter');
    Route::get('/itens/novo', 'cadastroItem')->name('itens.new');
    Route::post('/itens/novo', 'createItem')->name('itens.create');
    Route::get('/itens/editar/{id}', 'editarItem')->name('itens.edit');
    Route::post('/itens/editar/{id}', 'updateItem')->name('itens.update');
    Route::get('/itens/excluir/{id}', 'deleteItem')->name('itens.delete');
});

Route::middleware(['auth', 'admin'])->controller(ItemController::class)->group(function(){
    Route::get('/itens/fornecedores/{id}', 'tabelaPrecoItemFornecedor')->name('itens.fornecedores');
    Route::post('/itens/fornecedores/atualiza-valor', 'updateValorUnitario')->name('itens.fornecedores-atualiza-valor');
});

/** --------------------------------------------- */
/**       Rotas Classe ItemSetorController        */
Route::middleware(['auth'])->controller(ItemSetorController::class)->group(function(){
    Route::get('/', 'readItemSetorIndex')->name('index');
    Route::get('/itens-setor/estoque/{setor_id}', 'readItemSetor')->name('itemSetor.show');
    Route::get('/itens-setor/novo', 'cadastroItemSetor')->name('itemSetor.new');
    Route::post('/itens-setor/novo', 'createItemSetor')->name('itemSetor.create');
    Route::post('/itens-setor/atualiza-estoque', 'updateQtdEstoque')->name('itemSetor.update-estoque');
    Route::post('/itens/setor/excluir', 'deleteItemSetor')->name('itemSetor.delete');
});

/** --------------------------------------------- */
/**     Rotas Classe SolicitacaoItemController    */
Route::middleware(['auth', 'admin'])->controller(SolicitacaoItemController::class)->group(function(){
    Route::get('/solicitacoes', 'readSolicitacoesGeral')->name('solicitacoes.show');
});

Route::middleware(['auth'])->controller(SolicitacaoItemController::class)->group(function(){
    Route::get('/solicitacoes-realizadas/{setor_id}', 'readSolicitacoesSetor')->name('solicitacoes-setor.show');
    Route::get('/solicitacoes/novo', 'cadastroSolicitacao')->name('solicitacoes.new');
    Route::post('/solicitacoes/novo', 'createSolicitacao')->name('solicitacoes.create');
});