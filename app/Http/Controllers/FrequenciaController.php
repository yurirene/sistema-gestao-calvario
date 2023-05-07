<?php

namespace App\Http\Controllers;

use App\DataTables\FrequenciaDataTable;
use App\Models\Programacao;
use App\Services\FrequenciaService;
use App\Traits\ControllerPadraoTrait;
use Illuminate\Http\Request;

class FrequenciaController extends Controller
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
        $this->service = FrequenciaService::class;
        $this->dataTable = FrequenciaDataTable::class;
        $this->paramsCreate = [
            'membros_comungantes' => $this->service::getMembrosToCheckbox(),
            'membros_nao_comungantes' => $this->service::getMembrosNaoComungantesToCheckbox()
        ];
        $this->paramsEdit = [
            'membros_comungantes' => $this->service::getMembrosToCheckbox(),
            'membros_nao_comungantes' => $this->service::getMembrosNaoComungantesToCheckbox()
        ];
        $this->view = 'frequencia-dominical';
    }
}
