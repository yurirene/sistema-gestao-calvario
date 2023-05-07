<?php

namespace App\Services;

use App\Models\Membro;
use App\Models\Programacao;
use Illuminate\Support\Facades\DB;
use Throwable;

class FrequenciaService
{
    public static function getMembrosToCheckbox() : array
    {
        try {
            $membros = Membro::where('comungante', true)->orderBy('nome')->get();
            $retorno = [];
            $programacao = null;
            if (!is_null(request()->route('model'))) {
                $programacao = Programacao::find(request()->route('model'));
                $presentes = $programacao->presentes->pluck('id')->toArray();
            }
            foreach ($membros as $key => $membro) {
                $retorno[$key] = [
                    'id' => $membro->id,
                    'nome' => $membro->nome,
                    'presente' => false
                ];
                if ($programacao && in_array($membro->id, $presentes)) {
                    $retorno[$key]['presente'] = true;
                }
            }
            return $retorno;
        } catch (Throwable $th) {
            throw $th;
        }
    }
    public static function getMembrosNaoComungantesToCheckbox() : array
    {
        try {
            $membros = Membro::where('comungante', false)->orderBy('nome')->get();
            $retorno = [];
            $programacao = null;
            if (!is_null(request()->route('model'))) {
                $programacao = Programacao::find(request()->route('model'));
                $presentes = $programacao->presentes->pluck('id')->toArray();
            }
            foreach ($membros as $key => $membro) {
                $retorno[$key] = [
                    'id' => $membro->id,
                    'nome' => $membro->nome,
                    'presente' => false
                ];
                if ($programacao && in_array($membro->id, $presentes)) {
                    $retorno[$key]['presente'] = true;
                }
            }
            return $retorno;
        } catch (Throwable $th) {
            throw $th;
        }
    }


    public static function store(array $request) : ?Programacao
    {
        DB::beginTransaction();
        try {
            $programacao = Programacao::create([
                'nome' => $request['nome'],
                'data' => $request['data'],
                'visitantes' => $request['visitantes'],
                'visitantes_criancas' => $request['visitantes_criancas'] ?? 0,
                'is_culto' => isset($request['is_culto']) ? true : false,
                'nome_visitantes' => $request['nome_visitantes']
            ]);
            $programacao->presentes()->sync($request['membros']);
            DB::commit();
            return $programacao;
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public static function update(array $request, Programacao $programacao) : ?Programacao
    {
        DB::beginTransaction();
        try {
            $programacao->update([
                'nome' => $request['nome'],
                'data' => $request['data'],
                'visitantes' => $request['visitantes'],
                'visitantes_criancas' => $request['visitantes_criancas'],
                'is_culto' => isset($request['is_culto']) ? true : false,
                'nome_visitantes' => $request['nome_visitantes']
            ]);
            $programacao->presentes()->sync($request['membros']);
            DB::commit();
            return $programacao;
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public static function delete($programacao) : ?Programacao
    {
        DB::beginTransaction();
        try {
            $programacao = Programacao::find($programacao);
            $programacao->presentes()->sync([]);
            $programacao->delete();
            DB::commit();
            return $programacao;
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public static function getFrequencia(Membro $membro)
    {
        try {
            $qtdCulto = Programacao::where('is_culto', true)
                ->whereYear('data', '>=', $membro->ano_membresia)
                ->get()
                ->count();
            $qtdPresente = $membro->presencas()->where('is_culto', true)->count();
            $porcentagem = round(($qtdPresente * 100) / $qtdCulto, 2);
            return $porcentagem . "% (" . $qtdPresente . ")";
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
