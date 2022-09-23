<?php

namespace App\Http\Controllers;

use App\DataTables\ProgramacoesDataTable;
use App\Models\Programacao;
use App\Services\ProgramacaoService;
use App\Traits\ControllerPadraoTrait;
use Illuminate\Http\Request;

class ProgramacaoController extends Controller
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
        $this->model = Programacao::class;
        $this->service = ProgramacaoService::class;
        $this->dataTable = ProgramacoesDataTable::class;
        $this->paramsCreate = [
            'membros' => $this->service::getMembrosToCheckbox()
        ];
        $this->paramsEdit = [
            'membros' => $this->service::getMembrosToCheckbox()
        ];
        $this->view = 'programacoes';
    }
}
