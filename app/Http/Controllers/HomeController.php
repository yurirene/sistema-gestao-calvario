<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Services\HomeService;
use App\Services\UsuarioService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'totalizadores' => HomeService::totalizadores(),
            'grafico_frequencia' => HomeService::graficoFrequencia()
        ]);
    }

    public function usuarios(UsersDataTable $dataTable)
    {
        return $dataTable->render('usuarios');
    }

    public function trocarSenha(Request $request)
    {
        try {
            UsuarioService::trocarSenha($request->all());
            return redirect()->back()->with([
                'mensagem' => 'Operação Realizada com Sucesso!',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'mensagem' => 'Erro ao Realizar Operação',
                'status' => false
            ]);
        }
    }
}
