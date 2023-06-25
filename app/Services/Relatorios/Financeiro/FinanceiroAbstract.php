<?php

namespace App\Services\Relatorios\Financeiro;

use App\Interfaces\RelatorioInterface;
use App\Models\Relatorio;
use Throwable;

abstract class FinanceiroAbstract
{
    public const TIPO_RELATORIO = Relatorio::TIPO_FINANCEIRO;
    public const CATEGORIA = Relatorio::CATEGORIAS[self::TIPO_RELATORIO];
    public const VIEW = 'relatorios.financeiro';
}
