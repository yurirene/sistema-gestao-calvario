<?php

namespace App\Http\Controllers;

use App\DataTables\MembrosDataTable;
use App\Models\Membro;
use App\Services\CargoService;
use App\Services\MembroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class MembroController extends Controller
{
    
    public function index(MembrosDataTable $dataTable)
    {
        try {
            return $dataTable->render('membros.index', []);
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()->route('home')->withErrors(['Erro ao realizar essa operação.']);
        }
    }
    public function create()
    {
        try {
            return view('membros.form', [
                'cargos' => CargoService::getCargosForSelect()
            ]);
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()->route('home')->withErrors(['Erro ao realizar essa operação.']);
        }
    }

    public function store(Request $request)
    {
        try {
            MembroService::store($request->all());
            return redirect()->route('membros.index')->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {

            return redirect()->back()->with([
                'mensagem' => 'Erro ao Realizar Operação',
                'status' => false
            ])->withInput();
        }
    }

    public function edit(Membro $membro)
    {
        try {
            return view('membros.form', [
                'membro' => $membro,
                'cargos' => CargoService::getCargosForSelect()
            ]);
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()->route('home')->withErrors(['Erro ao realizar essa operação.']);
        }
    }

    public function update(Membro $membro, Request $request)
    {
        try {
            MembroService::update($request->all(), $membro);
            return redirect()->route('membros.index')->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {

            return redirect()->back()->with([
                'mensagem' => 'Erro ao Realizar Operação',
                'status' => false
            ])->withInput();
        }
    }

    public function delete(Membro $membro)
    {
        try {
            MembroService::delete($membro);
            return redirect()->route('membros.index')->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {

            return redirect()->back()->with([
                'mensagem' => 'Erro ao Realizar Operação',
                'status' => false
            ])->withInput();
        }
    }
}
