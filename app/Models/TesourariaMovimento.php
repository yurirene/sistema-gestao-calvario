<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesourariaMovimento extends Model
{
    protected $table = 'tesouraria_movimentos';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public const ENTRADA = 1;
    public const SAIDA = 0;
}
