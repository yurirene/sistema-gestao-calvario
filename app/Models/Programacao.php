<?php

namespace App\Models;

use App\Casts\DataBr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programacao extends Model
{
    use HasFactory;
    protected $table = 'programacoes';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'data' => DataBr::class
    ];

    public function presentes()
    {
        return $this->belongsToMany(Membro::class,'participacoes');
    }
}
