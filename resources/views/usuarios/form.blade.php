@extends('layouts.template')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários</h1>
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
                            {!! Form::open(['url' => route('usuarios.store'), 'method' => 'POST']) !!}
                            @else
                            {!! Form::model($model, ['url' => route('usuarios.update', $model->id), 'method' => 'PUT']) !!}
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Nome') !!}<span class="text-danger">*</span>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required'=>true, 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('email', 'E-mail') !!}<span class="text-danger">*</span>
                                        {!! Form::text('email', null, ['class' => 'form-control', 'required'=>true, 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('password', 'Senha') !!}
                                        {!! Form::password('password', ['class' => 'form-control', 'step' => '1', 'min' => '0', 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success"><i class='fas fa-save'></i> {{(isset($model) ? 'Atualizar' : 'Cadastrar')}}</button>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-default" ><i class="fas fa-arrow-left"></i> Voltar</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

