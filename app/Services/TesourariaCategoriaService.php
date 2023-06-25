<?php

namespace App\Services;

use App\Models\Cargo;
use App\Models\TesourariaCategoria;
use Exception;

class TesourariaCategoriaService
{

    public const ENTRADA = 1;
    public const SAIDA = 0;

    public const TIPOS = [
        self::ENTRADA => 'Entrada',
        self::SAIDA => 'Saída'
    ];


    /**
     * Retorna um array contendo as categorias com suas subcategorias cadastradas
     *
     * @return array
     */
    public static function getCategorias(): array
    {
        try {
            $dados = TesourariaCategoria::get()->toArray();
            $retorno = [
                self::ENTRADA => [],
                self::SAIDA => []
            ];
            foreach ($dados as $dado) {
                if ($dado['tipo'] == self::ENTRADA) {
                    array_push(
                        $retorno[self::ENTRADA],
                        [
                            'id' => $dado['id'],
                            'nome' => $dado['nome']
                        ]
                    );
                } else {
                    array_push(
                        $retorno[self::SAIDA],
                        [
                            'id' => $dado['id'],
                            'nome' => $dado['nome']
                        ]
                    );
                }
            }
            return $retorno;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Listar categorias
     *
     * @return array
     */
    public static function getCategoriaToSelect(): array
    {
        $dados = [
            self::ENTRADA => [],
            self::SAIDA => []
        ];
        TesourariaCategoria::orderBy('nome')
            ->get()
            ->map(function ($item) use (&$dados) {
                $dados[$item->tipo][$item->id] = $item->nome;
            })
            ->toArray();
        $retorno['Entradas'] = $dados[self::ENTRADA];
        $retorno['Saidas'] = $dados[self::SAIDA];
        return ['' => 'Selecione uma categoria'] + $retorno;
    }


    /**
     * Função para salvar os dados da categoria
     *
     * @param array $request
     * @return void
     */
    public static function store(array $request)
    {
        try {
            TesourariaCategoria::create([
                'nome' => $request['nome'],
                'tipo' => $request['tipo']
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    /**
     * Função para atualizar dados da categoria
     *
     * @param TesourariaCategoria $categoria
     * @param array $request
     * @return void
     */
    public static function update(
        array $request,
        TesourariaCategoria $categoria
    ): void {
        try {
            $categoria->update([
                'nome' => $request['nome']
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Deletar Categoria
     *
     * @param integer $id
     * @return void
     */
    public static function delete($id): void
    {
        try {
            $categoria = TesourariaCategoria::find($id);
            $categoria->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
