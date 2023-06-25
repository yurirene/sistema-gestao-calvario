@extends('layouts.template')

@section('title', 'Movimentos')

@section('content_header')
    <h1>Movimentos</h1>
@stop

@section('content')

<div class="row mb-3">
    <div class="col-md-4 col-sm-4 col-12">
        <div class="info-box shadow">
            <span class="info-box-icon bg-success"><i class="fas fa-arrow-down"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Entrada</span>
                <span class="info-box-number">Gyd$ <b id="totalizador-entradas"></b></span>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-12">
        <div class="info-box shadow">
            <span class="info-box-icon bg-danger"><i class="fas fa-arrow-up"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Saída</span>
                <span class="info-box-number">Gyd$ <b id="totalizador-saidas"></b></span>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-12">
        <div class="info-box shadow">
            <span class="info-box-icon bg-info"><i class="fas fa-dollar-sign"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Saldo</span>
                <span class="info-box-number">Gyd$ <b id="totalizador-total"></b></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card card-outline card-primary h-100">
            <div class="card-header">
                Movimentos
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="card card-outline-primary collapsed-card">
                            <div class="card-header">
                                Filtros
                                <div class="card-tools">
                                    <button type="button"
                                        class="btn btn-tool" data-card-widget="collapse"
                                    >
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('tipo', 'Tipo') !!}
                                            {!! Form::select('tipo',
                                                [
                                                    '' => 'Tipo',
                                                    'S' => 'Saída',
                                                    'E' => 'Entrada'
                                                ],
                                                null,
                                                ['class' => 'form-control', 'id' => 'tipo']
                                            ) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('data_lancamento', 'Data Lançamento') !!}
                                            {!! Form::text(
                                                'data_lancamento',
                                                null,
                                                [
                                                    'class' => 'form-control isDateRange',
                                                    'autocomplete' => 'off',
                                                    'id' => 'periodo'
                                                ]
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-secondary" type="button" id="filtrar">Filtrar</button>
                                        <button class="btn btn-secondary" type="button" id="resetar">Limpar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')

{!! $dataTable->scripts() !!}

<script>

    const table = $('#movimentos-table');

    table.on('preXhr.dt', function(e, settings, data){
        data.tipo = $('#tipo').val();
        data.periodo = $('#periodo').val();
    });


    table.on('xhr.dt', function ( e, settings, json, xhr ) {
        if (json.totalizadores) {
            let total = json.totalizadores;
            $('#totalizador-entradas').text(total.entradas);
            $('#totalizador-saidas').text(total.saidas);
            $('#totalizador-total').text(total.total);
        }

    } )

    $('#filtrar').on('click', function (){
        table.DataTable().ajax.reload();
        return false;
    });

    $('#resetar').on('click', function (){
        $('#tipo').val(null).trigger('change');
        $('#periodo').val(null).trigger('change');
        table.DataTable().ajax.reload();
        return false;
    });
</script>
@endpush
