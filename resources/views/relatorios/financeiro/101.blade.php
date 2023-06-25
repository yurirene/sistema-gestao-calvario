@extends('layouts.template')

@section('title', 'Turmas')

@section('content_header')
    <h1>Relatório 101</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card card-outline card-primary">
                <div class="card-header">
                   Filtros
                </div>
                <div class="card-body">

                </div>
                <div class="card-footer">
                    <a class="btn btn-secondary" href="{{route('relatorios.index')}}">
                        <em class="fas fa-arrow-left"></em>
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

