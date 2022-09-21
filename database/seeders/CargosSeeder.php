<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;

class CargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = [
            [
                'id' => 1,
                'nome' => 'presbitero',
                'descricao' => 'Presbítero',
            ],
            [
                'id' => 2,
                'nome' => 'diacono',
                'descricao' => 'Diácono'
            ],
            [
                'id' => 3,
                'nome' => 'diretoria-si',
                'descricao' => 'Diretoria de Sociedade Interna'
            ],
            [
                'id' => 4,
                'nome' => 'lider-infantil',
                'descricao' => 'Líder Ministério Infantil'
            ],
            [
                'id' => 5,
                'nome' => 'lider-louvor',
                'descricao' => 'Líder Ministério de Louvor'
            ]
        ];
        try {
            
            foreach ($cargos as $cargo) {
                Cargo::updateOrCreate([
                    'id' => $cargo['id']
                ], $cargo);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }
}
