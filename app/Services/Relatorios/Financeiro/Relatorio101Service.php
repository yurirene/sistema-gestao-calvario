<?php

namespace App\Services\Relatorios\Financeiro;

use App\Interfaces\RelatorioInterface;
use Throwable;

class Relatorio101Service extends FinanceiroAbstract implements RelatorioInterface
{
    /**
     * Retorna os dados com as informações necessárias para o formulário
     * do relatório
     *
     * @return array
     */
    public static function getDadosForm(): array
    {
        return[
            'view' => self::VIEW . '.101',
            'dados' => []
        ];
    }

    /**
     * Recebe os dados que vem do formulário e
     * Retorna o formulário renderizado
     *
     * @param array $dados
     * @return array
     */
    public static function render(array $dados): array
    {
        return [];
    }

}
