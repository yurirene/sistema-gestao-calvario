<?php

namespace App\Services;

use App\Models\Evento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class EventoService
{
    public static function getEventos(array $data) : array
    {
        try {
            $colunas = ['id', 'titulo', 'inicio', 'final', 'color'];

            $inicio = (!empty($data['start'])) ? ($data['start']) : ('');
            $final = (!empty($data['end'])) ? ($data['end']) : ('');

            $eventos = Evento::select('id','titulo as title', 'inicio as start', 'final as end', 'cor as color')
                ->whereBetween('inicio', [$inicio, $final])
                ->get($colunas)
                ->toArray();

            return $eventos;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function store(array $data) : Evento
    {
        DB::beginTransaction();
        try {
            $data['user_id'] = Auth::id();
            $evento = Evento::create($data);
            DB::commit();
            return $evento;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public static function update(array $data) : Evento
    {
        DB::beginTransaction();
        try {
            $evento = Evento::find($data['id']);
            $evento->fill($data);
            $evento->save();

            DB::commit();
            return $evento;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public static function destroy(array $data) : bool
    {
        DB::beginTransaction();
        try {
            $evento = Evento::find($data['id']);
            $evento = $evento->delete();

            DB::commit();
            return $evento;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

}
