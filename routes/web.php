<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\MembroController;
use App\Http\Controllers\TurmaController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'usuarios'])->name('usuarios');


Route::group([], function() {
    Route::resource('membros', MembroController::class)->parameter('membros', 'model')->names('membros')->except(['show', 'destroy']);
    Route::get('membros/{model}/delete', [ MembroController::class, 'delete'])->name('membros.delete');

    Route::get('eventos/', [EventoController::class, 'index'])->name('eventos.index');
    Route::post('eventos/', [EventoController::class, 'store'])->name('eventos.store');
    Route::put('eventos/', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('eventos/', [EventoController::class, 'destroy'])->name('eventos.destroy');

    Route::resource('turmas', TurmaController::class)->parameter('turmas', 'model')->names('turmas')->except(['destroy']);
    Route::get('turmas/{model}/delete', [ TurmaController::class, 'delete'])->name('turmas.delete');
    
    Route::post('turmas/{model}/incluir-alunos', [ TurmaController::class, 'incluirAluno'])->name('turmas.alunos.incluir');
    Route::get('turmas/{model}/excluir-alunos/{aluno}', [ TurmaController::class, 'excluirAluno'])->name('turmas.alunos.excluir');

    Route::post('turmas/{model}/aula-adicionar', [ TurmaController::class, 'incluirAula'])->name('turmas.aulas.incluir');
    Route::post('turmas/{model}/aula-editar/{aula}', [ TurmaController::class, 'updateAula'])->name('turmas.aulas.update');
    Route::get('turmas/{model}/aula-delete/{aula}', [ TurmaController::class, 'excluirAula'])->name('turmas.aulas.excluir');
    
    Route::get('turmas/{model}/aula-frequencia/{aula}', [ TurmaController::class, 'frequencia'])->name('turmas.aulas.frequencia');
    Route::post('turmas/{model}/aula-frequencia/{aula}', [ TurmaController::class, 'updateFrequencia'])->name('turmas.aulas.frequencia.update');
    
    Route::get('turmas/{model}/datatable-alunos', [ TurmaController::class, 'dataTableAlunos'])->name('turmas.alunos.datatable');
    Route::get('turmas/{model}/datatable-aulas', [ TurmaController::class, 'dataTableAulas'])->name('turmas.aulas.datatable');


});