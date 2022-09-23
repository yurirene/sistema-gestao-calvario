<?php 

namespace App\Services;

use App\Models\Cargo;

class CargoService
{
    public static function getCargosForSelect() : array
    {
        try {
            return Cargo::all()->pluck('descricao', 'id')->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}