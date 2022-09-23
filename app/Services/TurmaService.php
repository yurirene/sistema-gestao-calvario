<?php 

namespace App\Services;

use App\Models\Aula;
use App\Models\Cargo;
use App\Models\Membro;
use App\Models\Turma;
use Illuminate\Support\Collection;
use JeroenNoten\LaravelAdminLte\Components\Tool\Datatable;
use Throwable;

class TurmaService
{
    public static function getTurmas() : Collection
    {
        try {
            return Turma::all();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getTurmasToSelect() : array
    {
        try {
            return Turma::all()->pluck('nome', 'id')->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public static function store(array $request) : ?Turma
    {
        try {
            return Turma::create([
                'nome' => $request['nome'],
                'professor_id' => $request['professor_id'],
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function update(array $request, Turma $turma) : ?Turma
    {
        try {
            $turma->update([
                'nome' => $request['nome'],
                'professor_id' => $request['professor_id'],
            ]);
            return $turma;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function delete($turma) : void
    {
        try {
            $turma = Turma::find($turma);
            $turma->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getAlunos(int $turma)
    {
        try {
            $dados = Turma::find($turma)->alunos->map(function($item) use ($turma) {
                return [
                    'acao' => view('turmas.actions.action-alunos',['turma' => $turma, 'id' => $item->id])->render(),
                    'nome' => $item->nome
                ];
            });
            return datatables()::of($dados)->rawColumns(['acao'])->make();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function getAulas(int $turma)
    {
        try {
            $dados = Turma::find($turma)->aulas->map(function($item) use ($turma) {
                return [
                    'acao' => view('turmas.actions.action-aulas',
                        [
                            'id' => $item->id, 
                            'turma' => $turma,
                            'informacao' => $item->toJson(),
                            'aula' => $item->assunto
                        ])->render(),
                    'data' => $item->data,
                    'assunto' => $item->assunto,
                    'presentes' => $item->presentes->count(),
                    'observacao' => $item->observacao
                ];
            });
            return datatables()::of($dados)->rawColumns(['acao'])->make();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getMembrosNaoMatriculados() : array
    {
        try {
            return Membro::whereDoesntHave('turma')
                ->get()
                ->pluck('nome','id')
                ->toArray();
        } catch (Throwable $th) {
            throw $th;
        }
    }

    public static function incluirAluno(Turma $turma, array $request) : void
    {
        try {
            $turma->alunos()->attach($request['aluno_id']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function excluirAluno(Turma $turma, int $aluno) : void
    {
        try {
            $turma->alunos()->detach($aluno);
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    public static function incluirAula(Turma $turma, array $request) : Aula
    {
        try {
            return Aula::create([
                'assunto' => $request['assunto'],
                'observacao' => $request['observacao'],
                'data' => $request['data'],
                'turma_id' => $turma->id
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function updateAula(Turma $turma, int $aula, array $request) : Aula
    {
        try {
            $aula = Aula::find($aula);
            $aula->update([
                'assunto' => $request['assunto'],
                'observacao' => $request['observacao'],
                'data' => $request['data'],
                'turma_id' => $turma->id
            ]);
            return $aula;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function deleteAula(Turma $turma, int $aula) : void
    {
        try {
            $aula = Aula::find($aula);
            $aula->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function frequencia(Turma $turma, int $aula) : array
    {
        try {
            $presentes = Aula::find($aula)->presentes->pluck('id')->toArray();
            $alunos = $turma->alunos->map(function($item) use ($presentes) {
                return [
                    'id' => $item->id,
                    'nome' => $item->nome,
                    'presente' => in_array($item->id, $presentes)
                ];
            })
            ->toArray();
            return $alunos;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public static function updateFrequencia(Turma $turma, int $aula, array $request) : void
    {
        try {
            Aula::find($aula)->presentes()->sync($request['presentes'] ?? []);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
}