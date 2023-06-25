<?php

namespace Database\Seeders;

use App\Models\Relatorio;
use Illuminate\Database\Seeder;

class RelatorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relatorios = [
            [
                'codigo' => '101',
                'titulo' => 'Dizimistas por Mês',
                'categoria' => Relatorio::TIPO_FINANCEIRO,
                'service' => 'App\Services\Relatorios\Financeiro\Relatorio101Service'
            ],
            [
                'codigo' => '102',
                'titulo' => 'Número de Dizimistas por Mês',
                'categoria' => Relatorio::TIPO_FINANCEIRO,
                'service' => 'App\Services\Relatorios\Financeiro\Relatorio102Service'
            ],
            [
                'codigo' => '103',
                'titulo' => 'Entradas por Categoria',
                'categoria' => Relatorio::TIPO_FINANCEIRO,
                'service' => 'App\Services\Relatorios\Financeiro\Relatorio103Service'
            ],
            [
                'codigo' => '104',
                'titulo' => 'Saídas por Categoria',
                'categoria' => Relatorio::TIPO_FINANCEIRO,
                'service' => 'App\Services\Relatorios\Financeiro\Relatorio104Service'
            ],
            [
                'codigo' => '105',
                'titulo' => 'Entradas e Saídas',
                'categoria' => Relatorio::TIPO_FINANCEIRO,
                'service' => 'App\Services\Relatorios\Financeiro\Relatorio105Service'
            ],
        ];

        foreach ($relatorios as $relatorio) {
            Relatorio::updateOrCreate(
                ['codigo' => $relatorio['codigo']],
                $relatorio
            );
        }
    }
}
