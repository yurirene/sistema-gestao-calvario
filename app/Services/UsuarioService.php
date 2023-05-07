<?php

namespace App\Services;

use App\Models\Modulo;
use App\Models\User;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UsuarioService
{

    public static function getUsers() : Collection
    {
        try {
            return User::all();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getUsersToSelect() : array
    {
        try {
            return User::all()->pluck('nome', 'id')->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function store(array $request) : ?User
    {
        try {
            return User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function update(array $request, User $usuario) : ?User
    {
        try {
            $usuario->update([
                'name' => $request['name'],
                'email' => $request['email'],
            ]);
            if (!empty($request['password'])) {
                $usuario->update(['password' => Hash::make($request['password'])]);
            }
            return $usuario;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function delete($usuario) : void
    {
        try {
            $usuario = User::find($usuario);
            $usuario->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function trocarSenha(array $request): void
    {
        if (!Hash::check($request['senhaAntiga'], auth()->user()->password)) {
            throw new Exception("Senha Incorreta", 418);
        }
        auth()->user()->update([
            'password' => Hash::make($request['novaSenha'])
        ]);
    }

    public static function syncPermissao(array $request): void
    {
        $usuario = User::find($request['user_id']);
        $ativado = (bool) $request['ativado'];
        $permissao = $usuario->permissao
            ->pluck('id')
            ->toArray();
        if (
            $ativado
            && !in_array($request['modulo_id'], $permissao)
        ) {
            array_push($permissao, $request['modulo_id']);
        }
        if (
            !$ativado
            && in_array($request['modulo_id'], $permissao)
        ) {
            $key = array_search($request['modulo_id'], $permissao);
            unset($permissao[$key]);
        }
        $usuario->permissao()->sync($permissao);
    }


    public static function getModulos(): array
    {
        $modulos = Modulo::get();
        $usuario = null;
        if (request()->route('model')) {
            $usuario = User::find(request()->route('model'));
            $permissao = $usuario->permissao()
                ->get()
                ->pluck('id')
                ->toArray();

        }
        $retorno = [];
        foreach ($modulos as $key => $modulo) {
            $retorno[$key] = [
                'id' => $modulo->id,
                'nome' => $modulo->nome,
                'ativo' => false
            ];
            if (!empty($permissao) && in_array($modulo->id, $permissao)) {
                $retorno[$key]['ativo'] = true;
            }
        }
        return $retorno;
    }

}
