<?php

namespace App\Http\Controllers;

use App\Models\Relatorio;
use App\Services\RelatorioService;
use App\Traits\ControllerPadraoTrait;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    use ControllerPadraoTrait;

    protected $model;
    protected $service;
    protected $dataTable;
    protected $paramsCreate;
    protected $paramsEdit;
    protected $paramsIndex;
    protected $view;

    public function __construct()
    {
        $this->model = Relatorio::class;
        $this->service = RelatorioService::class;
        $this->dataTable = null;
        $this->paramsCreate = [];
        $this->paramsEdit = [];
        $this->paramsIndex = [
            'categorias' => $this->service::getRelatoriosPorCategoria()
        ];
        $this->view = 'relatorios';
    }

    public function show(string $codigo)
    {
        $dados = RelatorioService::getDadosRelatorio($codigo);
        return view($dados['view']);
    }
}
