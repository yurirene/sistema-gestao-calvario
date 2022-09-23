<?php

namespace App\Models;

use App\Casts\DataHoraBr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'inicio' => DataHoraBr::class,
        'final' => DataHoraBr::class
    ];
}
