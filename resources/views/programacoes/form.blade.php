@extends('layouts.template')

@section('title', 'Presença em Programações')

@section('content_header')
    <h1>Presença em Programações</h1>
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
                            {!! Form::open(['url' => route('programacoes.store'), 'method' => 'POST']) !!}
                            @else
                            {!! Form::model($model, ['url' => route('programacoes.update', $model->id), 'method' => 'PUT']) !!}
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('data', 'Data') !!}
                                        {!! Form::text('data', null, ['class' => 'form-control isDate', 'required'=>true, 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('nome', 'Nome') !!}<span class="text-danger">*</span>
                                        {!! Form::text('nome', null, ['class' => 'form-control', 'required'=>true, 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('visitantes', 'Visitantes (Adultos)') !!}
                                        {!! Form::number('visitantes', isset($model) ? null : 0, ['class' => 'form-control', 'step' => '1', 'min' => '0', 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('visitantes_criancas', 'Visitantes (Crianças)') !!}
                                        {!! Form::number('visitantes_criancas', isset($model) ? null : 0, ['class' => 'form-control', 'step' => '1', 'min' => '0', 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                                
                                <div class="col-md-8">
                                    <div class="form-group">
                                        {!! Form::label('nome_visitantes', 'Nome dos Visitantes') !!}
                                        {!! Form::textarea('nome_visitantes', null, ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => 3]) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_culto" class="form-check-input" id="culto" {{ isset($model) && $model->is_culto ? 'checked' : '' }}>
                                        <label class="form-check-label" for="culto">Culto Dominical</label>
                                  </div>
                                </div>
                            </div>
                            <hr>
                            <h5 class="mt-5">Presentes Comungantes</h5>
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        @foreach($membros_comungantes as $key => $membro)
                                        <div class="card col-md-12 mx-2 p-3">
                                            <div class="form-check form-check-inline">
                                                <input 
                                                    class="form-check-input" 
                                                    type="checkbox" 
                                                    name="membros[]" 
                                                    id="check{{$key}}" 
                                                    value="{{ $membro['id'] }}"  
                                                    data-toggle="toggle" 
                                                    data-on="<i class='fa fa-check'></i>" 
                                                    data-off="<i class='fa fa-times'></i>" 
                                                    data-onstyle="success" 
                                                    data-offstyle="danger"
                                                    data-size="mini"
                                                    {{ $membro['presente'] ? 'checked' : '' }}>
                                                <label class="form-check-label ml-2" for="check{{$key}}">{{ $membro['nome'] }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <h5>Presentes Não Comungantes</h5>
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        @foreach($membros_nao_comungantes as $key => $membro)
                                        <div class="card col-md-12 mx-2 p-3">
                                            <div class="form-check form-check-inline">
                                                <input 
                                                    class="form-check-input" 
                                                    type="checkbox" 
                                                    name="membros[]" 
                                                    id="check{{$key}}" 
                                                    value="{{ $membro['id'] }}"  
                                                    data-toggle="toggle" 
                                                    data-on="<i class='fa fa-check'></i>" 
                                                    data-off="<i class='fa fa-times'></i>" 
                                                    data-onstyle="success" 
                                                    data-offstyle="danger"
                                                    data-size="mini"
                                                    {{ $membro['presente'] ? 'checked' : '' }}>
                                                <label class="form-check-label ml-2" for="check{{$key}}">{{ $membro['nome'] }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success"><i class='fas fa-save'></i> {{(isset($model) ? 'Atualizar' : 'Cadastrar')}}</button>
                            <a href="{{ route('programacoes.index') }}" class="btn btn-default" ><i class="fas fa-arrow-left"></i> Voltar</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

