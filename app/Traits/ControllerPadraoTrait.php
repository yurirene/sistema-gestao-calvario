<?php 


namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

trait ControllerPadraoTrait {

    
    public function index()
    {
        $dataTable = new $this->dataTable;
        try {
            return $dataTable->render( $this->view . '.index');
        } catch (\Throwable $th) {

            return redirect()->back()->with([
                'mensagem' => 'Erro ao Realizar Operação',
                'status' => false
            ])->withInput();
        }
    }

    public function create()
    {
        try {
            return view( $this->view . '.form', $this->paramsCreate);
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()->route('home')->withErrors(['Erro ao realizar essa operação.']);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->service::store($request->all());
            return redirect()->route( $this->view . '.index')->with([
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

    public function edit($model)
    {
        try {
            $model = $this->model::find($model);
            $params = $this->paramsEdit;
            $params['model'] = $model;
            return view( $this->view . '.form', $params);
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()->route('home')->withErrors(['Erro ao realizar essa operação.']);
        }
    }

    public function update($model, Request $request)
    {
        try {
            $model = $this->model::find($model);
            $this->service::update($request->all(), $model);
            return redirect()->route( $this->view . '.index')->with([
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

    public function delete($model)
    {
        try {
            $this->service::delete($model);
            return redirect()->route( $this->view . '.index')->with([
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