<?php

namespace App\Services;

use App\Interfaces\RelatorioInterface;
use App\Models\Relatorio;
use Exception;
use Throwable;

class RelatorioService
{

    /**
     * Método que monta a listagem de relatório por categoria
     *
     * @return array
     */
    public static function getRelatoriosPorCategoria(): array
    {
        $retorno = [];
        foreach (Relatorio::CATEGORIAS as $tipo => $categoria) {
            $relatorios = Relatorio::where('categoria', $tipo)
                ->where('visivel', true)
                ->get()
                ->toArray();
            $retorno[$tipo] = [
                'tipo' => $categoria,
                'relatorios' => $relatorios
            ];
        }
        return $retorno;
    }

    /**
     * Retorna os dados do form e a view do relatório
     *
     * @param string $codigo
     * @return array
     */
    public static function getDadosRelatorio(string $codigo): array
    {
        $relatorio = Relatorio::where('codigo', $codigo)->first();
        $class = self::factory($relatorio->service);
        return $class::getDadosForm();
    }

    public static function factory($class): RelatorioInterface
    {
        if (!class_exists($class)) {
            throw new Exception("Classe {$class} não existe", 500);
        }
        return new $class;
    }
}
