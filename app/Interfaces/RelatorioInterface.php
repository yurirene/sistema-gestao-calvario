<?php

namespace App\Interfaces;

interface RelatorioInterface
{
    /**
     * Retorna os dados com as informações necessárias para o formulário
     * do relatório
     *
     * @return array
     */
    public static function getDadosForm(): array;

    /**
     * Recebe os dados que vem do formulário e
     * Retorna o formulário renderizado
     *
     * @param array $dados
     * @return array
     */
    public static function render(array $dados): array;
}
