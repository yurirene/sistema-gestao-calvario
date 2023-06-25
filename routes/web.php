<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembroController;
use App\Http\Controllers\FrequenciaController;
use App\Http\Controllers\TesourariaCategoriaController;
use App\Http\Controllers\TesourariaMovimentoController;
use App\Http\Controllers\TesourariaSubCategoriaController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('site');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('eventos/', [EventoController::class, 'index'])
        ->name('eventos.index');
    Route::post('trocar-senha/', [HomeController::class, 'trocarSenha'])
        ->name('comum.trocar-senha');
});


Route::group([
    'middleware' => ['auth', 'can:frequencia-dominical'],
    'modulo' => 'frequencia-dominical'
], function () {
    Route::resource('frequencia-dominical', FrequenciaController::class)
        ->parameter('frequencia-dominical', 'model')
        ->names('frequencia-dominical')
        ->except(['destroy']);
    Route::get('frequencia-dominical/{model}/delete', [FrequenciaController::class, 'delete'])
        ->name('frequencia-dominical.delete');

});

Route::group([
    'middleware' => ['auth', 'can:agenda'],
    'modulo' => 'agenda'
], function () {
    Route::get('eventos/', [EventoController::class, 'index'])->name('eventos.index');
    Route::post('eventos/', [EventoController::class, 'store'])->name('eventos.store');
    Route::put('eventos/', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('eventos/', [EventoController::class, 'destroy'])->name('eventos.destroy');
});

Route::group([
    'middleware' => ['auth', 'can:membresia'],
    'modulo' => 'membresia'
], function () {
    Route::resource('membros', MembroController::class)
        ->parameter('membros', 'model')
        ->names('membros')
        ->except(['show', 'destroy']);
    Route::get('membros/{model}/delete', [ MembroController::class, 'delete'])
        ->name('membros.delete');
    Route::post('membros/importar', [ MembroController::class, 'importar'])
        ->name('membros.importar');
});

Route::group([
    'middleware' => ['auth', 'can:ebd'],
    'modulo' => 'ebd'
], function () {
    Route::resource('turmas', TurmaController::class)
        ->parameter('turmas', 'model')
        ->names('turmas')
        ->except(['destroy']);
    Route::get('turmas/{model}/delete', [ TurmaController::class, 'delete'])
        ->name('turmas.delete');

    Route::post('turmas/{model}/incluir-alunos', [ TurmaController::class, 'incluirAluno'])
        ->name('turmas.alunos.incluir');
    Route::get('turmas/{model}/excluir-alunos/{aluno}', [ TurmaController::class, 'excluirAluno'])
        ->name('turmas.alunos.excluir');

    Route::post('turmas/{model}/aula-adicionar', [ TurmaController::class, 'incluirAula'])
        ->name('turmas.aulas.incluir');
    Route::post('turmas/{model}/aula-editar/{aula}', [ TurmaController::class, 'updateAula'])
        ->name('turmas.aulas.update');
    Route::get('turmas/{model}/aula-delete/{aula}', [ TurmaController::class, 'excluirAula'])
        ->name('turmas.aulas.excluir');

    Route::get('turmas/{model}/aula-frequencia/{aula}', [ TurmaController::class, 'frequencia'])
        ->name('turmas.aulas.frequencia');
    Route::post('turmas/{model}/aula-frequencia/{aula}', [ TurmaController::class, 'updateFrequencia'])
        ->name('turmas.aulas.frequencia.update');

    Route::get('turmas/{model}/datatable-alunos', [ TurmaController::class, 'dataTableAlunos'])
        ->name('turmas.alunos.datatable');
    Route::get('turmas/{model}/datatable-aulas', [ TurmaController::class, 'dataTableAulas'])
        ->name('turmas.aulas.datatable');
});


Route::group([
    'middleware' => ['auth', 'can:acessos'],
    'modulo' => 'acessos'
], function () {

    Route::resource('users', UsuarioController::class)
        ->parameter('users', 'model')
        ->names('usuarios')
        ->except(['show', 'destroy']);
    Route::get('users/{model}/delete', [UsuarioController::class, 'delete'])
        ->name('usuarios.delete');

    Route::post('users/permissao', [UsuarioController::class, 'syncPermissao'])
        ->name('usuarios.sync-permissao');

});

Route::group([
    'middleware' => ['auth'],
    'modulo' => 'area-tesouraria',
    'as' => 'area-tesouraria.',
    'prefix' => 'area-tesouraria'
], function () {

    Route::resource('categorias', TesourariaCategoriaController::class)
        ->parameter('categorias', 'model')
        ->names('categorias')
        ->except(['show', 'destroy', 'create', 'edit']);
    Route::get('categorias/{model}/delete', [TesourariaCategoriaController::class, 'delete'])
        ->name('categorias.delete');
    Route::get('movimentos/get-categorias/{tipo}', [TesourariaCategoriaController::class, 'getCategoriasToSelect'])
        ->name('categorias.get-categoria');

    Route::resource('movimentos', TesourariaMovimentoController::class)
        ->parameter('movimentos', 'model')
        ->names('movimentos')
        ->except(['show', 'destroy']);

    Route::get('movimentos/{model}/delete', [TesourariaMovimentoController::class, 'delete'])
        ->name('movimentos.delete');



});

// Route::group(['middleware' => ['auth'], 'modulo' => 'tesouraria'], function () {

// });
