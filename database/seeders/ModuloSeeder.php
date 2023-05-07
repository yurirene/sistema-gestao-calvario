<?php

namespace Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $routes = collect(Route::getRoutes())->filter(function ($route) {
            return in_array('web', $route->action['middleware'])
                && key_exists('modulo', $route->action);
        })
        ->pluck('action')
        ->filter(function ($item) {
            return strpos($item['as'], 'index');
        })
        ->unique('modulo')
        ->toArray();

        DB::beginTransaction();
        try {
            foreach ($routes as $route) {
                $nome = implode(
                    ' ',
                    array_map(
                        'ucfirst',
                        explode(
                            '-',
                            $route['modulo']
                        )
                    )
                );
                Modulo::updateOrCreate([
                    'name' => $route['modulo']
                ],
                [
                    'name' => $route['modulo'],
                    'nome' => $nome
                ]);
            }
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

    }
}
