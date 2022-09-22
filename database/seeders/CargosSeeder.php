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
                'nome' => 'pastor',
                'descricao' => 'Pastor',
            ],
            [
                'id' => 2,
                'nome' => 'presbitero',
                'descricao' => 'Presbítero',
            ],
            [
                'id' => 3,
                'nome' => 'diacono',
                'descricao' => 'Diácono'
            ],
            [
                'id' => 4,
                'nome' => 'diretoria-si',
                'descricao' => 'Diretoria de Sociedade Interna'
            ],
            [
                'id' => 5,
                'nome' => 'lider-infantil',
                'descricao' => 'Líder Ministério Infantil'
            ],
            [
                'id' => 6,
                'nome' => 'lider-louvor',
                'descricao' => 'Líder Ministério de Louvor'
            ],
            [
                'id' => 7,
                'nome' => 'professor-ebd',
                'descricao' => 'Professor(a) da EBD'
            ],
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
