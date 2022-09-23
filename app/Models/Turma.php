<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;
    protected $table = 'turmas';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function alunos()
    {
        return $this->belongsToMany(Membro::class, 'membro_turma');
    }

    public function professor()
    {
        return $this->belongsTo(Membro::class, 'professor_id');
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class, 'turma_id');
    }
}
