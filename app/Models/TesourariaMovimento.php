<?php

namespace App\Models;

use App\Casts\DataBr;
use App\Casts\MoedaBr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesourariaMovimento extends Model
{
    protected $table = 'tesouraria_movimentos';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'data' => DataBr::class,
        'valor' => MoedaBr::class
    ];
    public const ENTRADA = 1;
    public const SAIDA = 0;

    public function getValorFormatadoAttribute()
    {
        return number_format($this->valor, 2, ',', '.');
    }

    public function membro()
    {
        return $this->belongsTo(Membro::class);
    }
}
