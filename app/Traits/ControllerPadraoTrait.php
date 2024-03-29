<?php


namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

trait ControllerPadraoTrait
{
    private $mensagemErro = 'Erro ao realizar essa operação.';
    private $mensagemSucesso = 'Operação Realizada com Sucesso.';

    public function index()
    {
        try {
            if (isset($this->dataTable)) {
                $dataTable = new $this->dataTable;
                return $dataTable->render($this->view . '.index');
            }
            return view($this->view . '.index', $this->paramsIndex ?: []);
        } catch (\Throwable $th) {
            Log::error([
                'erro' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
            return redirect()->back()->with([
                'mensagem' => $this->mensagemErro,
                'status' => false
            ])->withInput();
        }
    }

    public function create()
    {
        try {
            return view( $this->view . '.form', $this->paramsCreate);
        } catch (Throwable $th) {
            Log::error([
                'erro' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
            return redirect()->route('home')->withErrors([$this->mensagemErro]);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->service::store($request->all());
            return redirect()->route( $this->view . '.index')->with([
                'mensagem' => $this->mensagemSucesso,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            Log::error([
                'erro' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);

            return redirect()->back()->with([
                'mensagem' => $th->getCode() == 418 ? $th->getMessage() : $this->mensagemErro,
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
            Log::error([
                'erro' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
            return redirect()->route('home')->withErrors([$this->mensagemErro]);
        }
    }

    public function update($model, Request $request)
    {
        try {
            $model = $this->model::find($model);
            $this->service::update($request->all(), $model);
            return redirect()->route($this->view . '.index')->with([
                'mensagem' => $this->mensagemSucesso,
                'status' => true
            ]);
        } catch (\Throwable $th) {

            Log::error([
                'erro' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
            return redirect()->back()->with([
                'mensagem' => $th->getCode() == 418 ? $th->getMessage() : $this->mensagemErro,
                'status' => false
            ])->withInput();
        }
    }

    public function delete($model)
    {
        try {
            $this->service::delete($model);
            return redirect()->route($this->view . '.index')->with([
                'mensagem' => $this->mensagemSucesso,
                'status' => true
            ]);
        } catch (\Throwable $th) {

            Log::error([
                'erro' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
            return redirect()->back()->with([
                'mensagem' => $th->getCode() == 418 ? $th->getMessage() : $this->mensagemErro,
                'status' => false
            ])->withInput();
        }
    }
}
