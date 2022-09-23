<?php

namespace App\Http\Controllers;

use App\DataTables\TurmasDataTable;
use App\Models\Turma;
use App\Services\MembroService;
use App\Services\TurmaService;
use App\Traits\ControllerPadraoTrait;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    use ControllerPadraoTrait;

    protected $model;
    protected $service;
    protected $dataTable;
    protected $paramsCreate;
    protected $paramsEdit;
    protected $view;

    public function __construct() 
    {
        $this->model = Turma::class;
        $this->service = TurmaService::class;
        $this->dataTable = TurmasDataTable::class;
        $this->paramsCreate = [
            'membros' => MembroService::getMembrosToSelect()
        ];
        $this->paramsEdit = [
            'membros' => MembroService::getMembrosToSelect()
        ];
        $this->view = 'turmas';
    }

    public function show(Turma $model)
    {
        try {
            return view('turmas.show', [
                'model' => $model,
                'membros' => $this->service::getMembrosNaoMatriculados()
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('turmas.index')->with([
                'mensagem' => 'Erro ao Realizar Operação',
                'status' => false
            ])->withInput();
        }
    }

    public function dataTableAlunos($turma)
    {
        try {
            return $this->service::getAlunos($turma);
        } catch (\Throwable $th) {
            return response()->json([], 500);
        }
    }

    public function dataTableAulas($turma)
    {
        try {
            return $this->service::getAulas($turma);
        } catch (\Throwable $th) {
            return response()->json([], 500);
        }
    }

    public function incluirAluno(Turma $model, Request $request)
    {
        try {
            $this->service::incluirAluno($model, $request->all());
            return redirect()->route( $this->view . '.show', $model->id)->with([
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

    public function excluirAluno(Turma $model, $aluno)
    {
        try {
            $this->service::excluirAluno($model, $aluno);
            return redirect()->route( $this->view . '.show',  $model->id)->with([
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

    public function incluirAula(Turma $model, Request $request)
    {
        try {
            $this->service::incluirAula($model, $request->all());
            return redirect()->route( $this->view . '.show', $model->id)->with([
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

    public function updateAula(Turma $model, $aula, Request $request)
    {
        try {
            $this->service::updateAula($model, $aula, $request->all());
            return redirect()->route( $this->view . '.show', $model->id)->with([
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

    public function excluirAula(Turma $model, $aula)
    {
        try {
            $this->service::deleteAula($model, $aula);
            return redirect()->route( $this->view . '.show', $model->id)->with([
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

    public function frequencia(Turma $model, $aula)
    {
        try {
            return response()->json($this->service::frequencia($model, $aula), 200);
        } catch (\Throwable $th) {
            return response()->json([], 500);
        }
    }

    public function updateFrequencia(Turma $model, $aula, Request $request)
    {
        try {
            $this->service::updateFrequencia($model, $aula, $request->all());
            return redirect()->route( $this->view . '.show', $model->id)->with([
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
