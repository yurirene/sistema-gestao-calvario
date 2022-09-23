<?php 

namespace App\Services;

use App\Models\Membro;
use Illuminate\Support\Facades\DB;

class HomeService
{
    public static function totalizadores() : array
    {
        return [
            'alunos' => DB::table('membro_turma')->count(),
            'membros' => Membro::count()
        ];
    }
}