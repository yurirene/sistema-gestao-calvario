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
                    Formulário
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col">
                            @if (!isset($model))
                            {!! Form::open(['url' => route('membros.store'), 'method' => 'POST']) !!}
                            @else
                            {!! Form::model($model, ['url' => route('membros.update', $model->id), 'method' => 'PUT']) !!}
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('nome', 'Nome') !!}<span class="text-danger">*</span>
                                        {!! Form::text('nome', null, ['class' => 'form-control', 'required'=>true, 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('nascimento', 'Data Nascimento') !!}
                                        {!! Form::text('nascimento', null, ['class' => 'form-control isDateFormat', 'required'=>false, 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('sexo', 'Sexo') !!}
                                        {!! Form::select('sexo',['M' => 'Masculino', 'F' => 'Feminino'], null, ['class' => 'form-control', 'required'=>true, 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('telefone', 'Telefone') !!}
                                        {!! Form::text('telefone', null, ['class' => 'form-control isCelular', 'required'=>false, 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('ano_membresia', 'Membro desde') !!}
                                        {!! Form::text('ano_membresia', null, ['class' => 'form-control isAno', 'required'=>false, 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('cargo_id', 'Cargo') !!}
                                        {!! Form::select('cargo_id', $cargos, null, ['class' => 'form-control', 'placeholder' => '-', 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('comungante', 'Comungante') !!} <br>
                                        {!! Form::checkbox('comungante', 1); !!}
                                    </div>
                                </div>
                               
                            </div>
                            <button class="btn btn-success"><i class='fas fa-save'></i> {{(isset($model) ? 'Atualizar' : 'Cadastrar')}}</button>
                            <a href="{{ route('membros.index') }}" class="btn btn-default" ><i class="fas fa-arrow-left"></i> Voltar</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

