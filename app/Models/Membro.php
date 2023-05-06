<?php

namespace App\Models;

use App\Casts\DataBr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;

    protected $table = 'membros';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at', 'nascimeto'];
    protected $casts = [
        'nascimento' => DataBr::class
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function turma()
    {
        return $this->belongsToMany(Turma::class, 'membro_turma', 'membro_id', 'turma_id');
    }
    
    public function presencas()
    {
        return $this->belongsToMany(Programacao::class, 'participacoes', 'membro_id', 'programacao_id');
    }
    

}
