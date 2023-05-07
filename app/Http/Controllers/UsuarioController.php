<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Services\UsuarioService;
use App\Traits\ControllerPadraoTrait;
use Illuminate\Support\Facades\Gate;
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
        $this->paramsCreate = [
            'modulos' => UsuarioService::getModulos()
        ];
        $this->paramsEdit = [
            'modulos' => UsuarioService::getModulos()
        ];
        $this->view = 'usuarios';
    }

    public function syncPermissao(Request $request)
    {
        try {
            UsuarioService::syncPermissao($request->all());
            return response()->json(['mensagem' => 'Permissão atualizada'], 200);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Algo deu errado'], 500);
        }
    }
}
