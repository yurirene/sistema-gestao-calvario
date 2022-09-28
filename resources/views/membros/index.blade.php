@extends('layouts.template')

@section('title', 'Membros')

@section('content_header')
    <h1>Membros</h1>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    Tabela de Membros
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal" id="modal-import" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Importar Contatos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => 'membros.importar', 'files' => true]) !!}
            <div class="modal-body">
                <div class="mb-3">
                    <label for="planilha" class="form-label">Planilha</label>
                    <input class="form-control" type="file" id="planilha" name="planilha" required="true">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Importar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop

@section('css')
@endsection

@push('js')

{!! $dataTable->scripts() !!}
@endpush