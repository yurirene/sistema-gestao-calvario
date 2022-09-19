<?php

namespace App\Http\Controllers;

use App\DataTables\MembrosDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class MembroController extends Controller
{
    
    public function index(MembrosDataTable $dataTable)
    {
        try {
            return $dataTable->render('membros.index', []);
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()->route('home')->withErrors(['Erro ao realizar essa operação.']);
        }
    }
    public function create()
    {
        try {
            return view('membros.form', []);
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()->route('home')->withErrors(['Erro ao realizar essa operação.']);
        }
    }
}
