<?php

namespace App\Http\Controllers;

use App\DataTables\TesourariaMovimentoDataTable;
use App\Models\TesourariaMovimento;
use App\Services\MembroService;
use App\Services\TesourariaCategoriaService;
use App\Services\TesourariaMovimentoService;
use App\Traits\ControllerPadraoTrait;
use Illuminate\Http\Request;

class TesourariaMovimentoController extends Controller
{

    use ControllerPadraoTrait;

    protected $model;
    protected $service;
    protected $dataTable;
    protected $paramsIndex;
    protected $paramsCreate;
    protected $paramsEdit;
    protected $view;

    public function __construct()
    {
        $this->model = TesourariaMovimento::class;
        $this->service = TesourariaMovimentoService::class;
        $this->dataTable = TesourariaMovimentoDataTable::class;
        $this->paramsCreate = [
            'tipos' => ['' => 'Selecione um Tipo'] + TesourariaCategoriaService::TIPOS,
            'categorias' => TesourariaCategoriaService::getCategoriaToSelect(),
            'membros' => ['' => 'Selecione um Membro'] + MembroService::getMembrosToSelect(true)
        ];
        $this->paramsEdit = [
            'tipos' => ['' => 'Selecione um Tipo'] + TesourariaCategoriaService::TIPOS,
            'categorias' => TesourariaCategoriaService::getCategoriaToSelect(),
            'membros' => MembroService::getMembrosToSelect(true)
        ];
        $this->view = 'area-tesouraria.movimentos';
    }
}
