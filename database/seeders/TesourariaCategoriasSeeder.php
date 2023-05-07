<?php

namespace Database\Seeders;

use App\Models\TesourariaCategoria;
use App\Models\TesourariaSubcategoria;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TesourariaCategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            1 => 'Despesas Fixas',
            2 => 'Despesas Variáveis',
            3 => 'Entradas'
        ];

        $subcategorias = [

            1 => [
                'CONTA DE ÁGUA',
                'CONTA DE ENERGIA ELÉTRICA',
                'CONTA DE INTERNET',
                'PASTOR - PREBENDA',
                'PASTOR - AUXÍLIO COMBUSTÍVEL',
                'PASTOR - 13º SALÁRIO',
                'PASTOR - AUXÍLIO MORADIA',
                'PASTOR - FÉRIAS',
                'SEMINARISTA - REPASSE OFERTA',
                'ÁGUA MINERAL - GARRAFÕES',
                'MANUTENÇÃO PREDIAL',
                'EMPRÉSTIMO',
                'JUNTA DIACONAL',
                'ZELADORIA',
                'REPASSE AO PRESBITÉRIO - 5% DÍZIMOS',
                'REPASSE AO SUPREMO CONCÍLIO',
            ],
            2 => [
                'ÁGUA MINERAL - GARRAFÕES',
                'AJUDA DE CUSTO',
                'ASSISTÊNCIA AOS IRMÃOS',
                'CONSELHO - CONTRIBUIÇÃO',
                'CULTO SOLENE - ITENS PARA O CAFEZINHO',
                'EBD - CAFÉ DA MANHÃ',
                'EBD - MATERIAL',
                'DESPESAS COM SUPERMERCADO',
                'MANUTENÇÃO PREDIAL',
                'MINISTÉRIO DE LOUVOR',
                'MINISTÉRIO INFANTIL',
                'UMP - CONTRIBUIÇÃO',
                'UPA - CONTRIBUIÇÃO',
                'ANIVERSÁRIO DA IGREJA',
                'CONFRATERNIZAÇÃO IGREJA'
            ],
            3 => [
                'DÍZIMOS',
                'OFERTAS'
            ]
        ];

        DB::beginTransaction();
        try {

            foreach ($categorias as $key => $categoria) {
                TesourariaCategoria::updateOrCreate(['id' => $key], ['nome' => $categoria]);
            }

            foreach ($subcategorias as $key => $subcategoria) {
                foreach ($subcategoria as $sub) {
                    TesourariaSubcategoria::updateOrCreate(
                        ['id' => $key],
                        [
                            'nome' => $sub,
                            'categoria_id' => $key
                        ]
                    );
                }
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
