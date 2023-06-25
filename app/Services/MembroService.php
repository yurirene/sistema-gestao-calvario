<?php

namespace App\Services;

use App\Imports\MembrosImport;
use App\Models\Membro;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class MembroService
{

    public static function getMembros() : Collection
    {
        try {
            return Membro::orderBy('nome')->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getMembrosToSelect(bool $somenteComungantes = false) : array
    {
        try {
            return Membro::when($somenteComungantes, function ($sql) {
                return $sql->where('comungante', true);
            })
            ->orderBy('nome')
            ->get()
            ->pluck('nome', 'id')
            ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function store(array $request) : ?Membro
    {
        try {
            return Membro::create([
                'nome' => $request['nome'],
                'telefone' => $request['telefone'],
                'sexo' => $request['sexo'],
                'nascimento' => $request['nascimento'],
                'ano_membresia' => $request['ano_membresia'],
                'comungante' => isset($request['comungante']) ? true : false,
                'cargo_id' => $request['cargo_id']
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function update(array $request, Membro $membro) : ?Membro
    {
        try {
            $membro->update([
                'nome' => $request['nome'],
                'telefone' => $request['telefone'],
                'sexo' => $request['sexo'],
                'nascimento' => $request['nascimento'],
                'ano_membresia' => $request['ano_membresia'],
                'comungante' => isset($request['comungante']) ? true : false,
                'cargo_id' => $request['cargo_id']
            ]);
            return $membro;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function delete($membro) : void
    {
        try {
            $membro = Membro::find($membro);
            $membro->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function importar(Request $request) : void
    {
        try {
            Excel::import(new MembrosImport(), $request->file('planilha'));
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
