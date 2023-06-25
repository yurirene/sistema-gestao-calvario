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
        $ENTRADA = 1;
        $SAIDA = 0;

        $dados = [

            $SAIDA => [
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
            $ENTRADA => [
                'DÍZIMOS',
                'OFERTAS'
            ]
        ];

        DB::beginTransaction();
        try {

            foreach ($dados as $tipo => $categorias) {
                foreach ($categorias as $categoria) {
                    TesourariaCategoria::updateOrCreate(['nome' => $categoria], [
                        'nome' => $categoria,
                        'tipo' => $tipo
                    ]);
                }
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
