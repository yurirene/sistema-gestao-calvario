<?php

namespace App\Services;

use App\Models\Cargo;
use App\Models\TesourariaCategoria;
use App\Models\TesourariaMovimento;
use Exception;
use Illuminate\Support\Facades\DB;

class TesourariaMovimentoService
{

    public const ENTRADA = 1;
    public const SAIDA = 0;
    public const LABELS = [
        self::ENTRADA => '<span class="badge badge-pill badge-success">Entrada</span>',
        self::SAIDA => '<span class="badge badge-pill badge-danger">Saída</span>',
    ];

    /**
     * Função para salvar os dados da categoria
     *
     * @param array $request
     * @return void
     */
    public static function store(array $request)
    {
        DB::beginTransaction();
        try {
            $movimento = TesourariaMovimento::create([
                'data' => $request['data'],
                'valor' => $request['valor'],
                'descricao' => $request['descricao'],
                'tipo' => $request['tipo'],
                'categoria_id' => $request['categoria_id'],
                'membro_id' => !empty($request['membro_id']) ? $request['membro_id'] : null,
            ]);
            if (!empty($request['path_comprovante'])) {
                $path = $request['path_comprovante']->store('public/comprovantes');
                $movimento->update([
                    'path_comprovante' => '/' . str_replace('public', 'storage', $path)
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
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
        TesourariaMovimento $movimento
    ): void {
        DB::beginTransaction();
        try {
            $movimento->update([
                'data' => $request['data'],
                'valor' => $request['valor'],
                'descricao' => $request['descricao'],
                'tipo' => $request['tipo'],
                'categoria_id' => $request['categoria_id'],
                'membro_id' => !empty($request['membro_id']) ? $request['membro_id'] : null,
            ]);

            if (!empty($request['path_comprovante'])) {
                if (!is_null($movimento->path_movimento)) {
                    $realPath = __DIR__ . '/../../storage/app/public';
                    $completePath = str_replace('/storage', $realPath, $movimento->path_comprovante);
                    unlink($completePath);
                }

                $path = $request['path_comprovante']->store('public/comprovantes');
                $movimento->update([
                    'path_comprovante' => '/' . str_replace('public', 'storage', $path)
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
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
            $categoria = TesourariaMovimento::find($id);
            $categoria->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
