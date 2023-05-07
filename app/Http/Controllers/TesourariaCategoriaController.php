<?php

namespace App\Http\Controllers;

use App\Models\TesourariaCategoria;
use App\Services\TesourariaCategoriaService;
use App\Traits\ControllerPadraoTrait;
use Illuminate\Http\Request;

class TesourariaCategoriaController extends Controller
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
        $this->model = TesourariaCategoria::class;
        $this->service = TesourariaCategoriaService::class;
        $this->dataTable = null;
        $this->paramsCreate = [];
        $this->paramsEdit = [];
        $this->paramsIndex = [
            'categorias' => $this->service::getCategoriasAndSubCategorias()
        ];
        $this->view = 'area-tesouraria.categorias';
    }
}
