<?php 

namespace App\Services;

use App\Models\Membro;
use Illuminate\Support\Collection;

class MembroService
{

    public static function getMembros() : Collection
    {
        try {
            return Membro::all();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getMembrosToSelect() : array
    {
        try {
            return Membro::all()->pluck('nome', 'id')->toArray();
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
}
