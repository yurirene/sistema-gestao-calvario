@extends('layouts.template')

@section('title', 'Turmas')

@section('content_header')
    <h1>Turmas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    Tabela de Turmas
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@endsection

@push('js')

{!! $dataTable->scripts() !!}
@endpush