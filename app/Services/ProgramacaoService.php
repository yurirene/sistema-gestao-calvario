<?php 

namespace App\Services;

use App\Models\Membro;
use App\Models\Programacao;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProgramacaoService
{
    public static function getMembrosToCheckbox() : array
    {
        try {
            $membros = Membro::all();
            $retorno = [];
            $programacao = null;
            if(!is_null(request()->route('model'))) {
                $programacao = Programacao::find(request()->route('model'));
                $presentes = $programacao->presentes->pluck('id')->toArray();
            }
            foreach ($membros as $key => $membro) {
                $retorno[$key] = [
                    'id' => $membro->id,
                    'nome' => $membro->nome,
                    'presente' => false
                ];
                if ($programacao) {
                    if (in_array($membro->id, $presentes)) {
                        $retorno[$key]['presente'] = true; 
                    }
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
                'visitantes' => $request['visitantes']
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
                'visitantes' => $request['visitantes']
            ]);
            $programacao->presentes()->sync($request['membros']);
            DB::commit();
            return $programacao;
        } catch (Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
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
}