<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{

    protected $table = 'relatorios';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public const TIPO_FINANCEIRO = 1;
    public const TIPO_EBD = 2;
    public const TIPO_FREQUENCIA = 3;
    public const CATEGORIAS = [
        self::TIPO_FINANCEIRO => 'Financeiro',
        self::TIPO_EBD => 'EBD',
        self::TIPO_FREQUENCIA => 'Frequência'
    ];
}
