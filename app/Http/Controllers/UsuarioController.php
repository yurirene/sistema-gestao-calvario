<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Services\UsuarioService;
use App\Traits\ControllerPadraoTrait;
use Illuminate\Http\Request;

class UsuarioController extends Controller
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
        $this->model = User::class;
        $this->service = UsuarioService::class;
        $this->dataTable = UsersDataTable::class;
        $this->paramsCreate = [];
        $this->paramsEdit = [];
        $this->view = 'usuarios';
    }
}
