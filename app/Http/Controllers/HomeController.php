<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'totalizadores' => HomeService::totalizadores()
        ]);
    }

    public function usuarios(UsersDataTable $dataTable)
    {
        return $dataTable->render('usuarios');
    }
}
