<?php

namespace App\Http\Controllers;

use App\DataTables\MembrosDataTable;
use App\Models\Membro;
use App\Services\CargoService;
use App\Services\MembroService;
use App\Traits\ControllerPadraoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class MembroController extends Controller
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
        $this->model = Membro::class;
        $this->service = MembroService::class;
        $this->dataTable = MembrosDataTable::class;
        $this->paramsCreate = [
            'cargos' => CargoService::getCargosForSelect()
        ];
        $this->paramsEdit = [
            'cargos' => CargoService::getCargosForSelect()
        ];
        $this->view = 'membros';
    }

    public function importar(Request $request)
    {
        try {
            MembroService::importar($request);
            return redirect()->route( $this->view . '.index')->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with([
                'mensagem' => 'Erro ao Realizar Operação',
                'status' => false
            ])->withInput();
        }
    }
}
