<?php 

namespace App\Services;

use App\Models\Membro;
use App\Models\Programacao;
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

    public static function graficoFrequencia() : array
    {
        try {
            $programacoes = Programacao::withCount('presentes')
                ->whereMonth('data', date('m'))
                ->orderBy('data', 'asc')
                ->get()
                ->map(function($item) {
                    return [
                        'nome' => $item->nome,
                        'data' => $item->data,
                        'presentes' => $item->presentes_count,
                        'visitantes' => $item->visitantes
                    ];
                });
            $labels = $programacoes->pluck('data', 'nome')->map(function($key, $value) {
                return $key . ' - ' . $value;
            })->values()->toArray();
            $dataSets = [];
            $dataSets[0] = [
                'label' => 'Visitantes',
                'data' => $programacoes->pluck('visitantes')->toArray(),
                'borderWidth' => 2,
                'borderRadius' => 5,
                'backgroundColor' => [
                    'rgba(54, 162, 235, 0.9)',
                ],
                'borderColor' => [
                    'rgba(54, 162, 235, 1)',
                ],
                'borderWidth' => 1
            ];
            $dataSets[1] = [
                'label' => 'Membros',
                'data' => $programacoes->pluck('presentes')->toArray(),
                'backgroundColor' => ['rgba(255, 99, 132, 0.9)'],
                'borderColor' => ['rgba(255, 99, 132, 1)'],
                'type' => 'line',
                'order' => 0
            ];

            $data = [
                'labels' => $labels,
                'datasets' => $dataSets
            ];
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}