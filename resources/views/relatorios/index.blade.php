@extends('layouts.template')

@section('title', 'Turmas')

@section('content_header')
    <h1>Relatórios</h1>
@stop

@section('content')
    <div class="row">
        @foreach($categorias as $categoria)
        <div class="col-md-4 mt-3">
            <div class="card card-outline card-primary">
                <div class="card-header">
                   Relatórios do tipo <b>{{$categoria['tipo']}}</b>
                </div>
                <div class="card-body">
                    <div class="list-group">

                    @foreach($categoria['relatorios'] as $relatorio)
                        <a href="{{ route('relatorios.show', $relatorio['codigo']) }}"
                            class="list-group-item list-group-item-action"
                        >
                            <em class="fas fa-file"></em>
                            {{ $relatorio['codigo'] }} - {{ $relatorio['titulo'] }}
                        </a>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@stop

