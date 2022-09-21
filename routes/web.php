<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\MembroController;
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
    Route::resource('membros', MembroController::class)->names('membros')->except(['show', 'destroy']);
    Route::get('membros/{membro}/delete', [ MembroController::class, 'delete'])->name('membros.delete');


    Route::resource('agendas', AgendaController::class)->names('agendas');
    Route::get('eventos/', [EventoController::class, 'index'])->name('eventos.index');
    Route::post('eventos/', [EventoController::class, 'store'])->name('eventos.store');
    Route::put('eventos/', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('eventos/', [EventoController::class, 'destroy'])->name('eventos.destroy');

});