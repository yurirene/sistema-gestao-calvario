<?php

namespace Database\Seeders;

use App\Models\Modulo;
use App\Models\User;
use Illuminate\Database\Seeder;

class SudoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $modulos = Modulo::get()->pluck('id');
        $usuario = User::where('email', 'yurirene@gmail.com')->first();
        $usuario->permissao()->sync($modulos);
    }
}
