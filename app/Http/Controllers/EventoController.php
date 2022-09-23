<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventoRequest;
use App\Models\Evento;
use App\Services\EventoService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $events = EventoService::getEventos($request->all());
            return response()->json($events);
        } catch (\Throwable $th) {
            return response()->json([]);
        }
    }

    public function store(EventoRequest $request)
    {
        try {
            $evento = EventoService::store($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Registro cadastrado com sucesso!',
                'data' => $evento,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Falha ao cadastrar o registro!',
            ]);
        }
    }

    public function update(EventoRequest $request)
    {
        try {
            $evento = EventoService::update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Registro cadastrado com sucesso!',
                'data' => $evento,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Falha ao atualizar o registro!',
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $evento = EventoService::destroy($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Registro deletado com sucesso!',
                'data' => $evento,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Falha ao deletar o registro!',
            ]);
        }
    }
}
