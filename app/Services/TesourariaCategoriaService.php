<?php

namespace App\Services;

use App\Models\Cargo;
use App\Models\TesourariaCategoria;

class TesourariaCategoriaService
{
    /**
     * Retorna um array contendo as categorias com suas subcategorias cadastradas
     *
     * @return array
     */
    public static function getCategoriasAndSubCategorias(): array
    {
        try {
            return TesourariaCategoria::with('subcategorias')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nome' => $item->nome,
                        'subcategorias' => $item->subcategorias
                            ->pluck('nome', 'id')
                            ->toArray()
                    ];
                })
                ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
