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
                            @if (!isset($turma))
                            {!! Form::open(['url' => route('turmas.store'), 'method' => 'POST']) !!}
                            @else
                            {!! Form::model($turma, ['url' => route('turmas.update', $turma->id), 'method' => 'PUT']) !!}
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
                                        {!! Form::label('professor_id', 'Professor') !!}<span class="text-danger">*</span>
                                        {!! Form::select('professor_id', $membros, null, ['class' => 'form-control', 'placeholder' => '-', 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success"><i class='fas fa-save'></i> {{(isset($turma) ? 'Atualizar' : 'Cadastrar')}}</button>
                            <a href="{{ route('turmas.index') }}" class="btn btn-default" ><i class="fas fa-arrow-left"></i> Voltar</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

