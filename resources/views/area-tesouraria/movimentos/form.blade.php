@extends('layouts.template')

@section('title', 'Movimentos')

@section('content_header')
    <h1>Movimentos</h1>
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
                            {!! Form::open([
                                'url' => route('area-tesouraria.movimentos.store'),
                                'method' => 'POST',
                                'files' => true
                            ]) !!}
                            @else
                            {!! Form::model($model, [
                                'url' => route('area-tesouraria.movimentos.update', $model->id),
                                'method' => 'PUT',
                                'files' => true
                            ]) !!}
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('tipo', 'Tipo') !!}
                                        {!! Form::select(
                                            'tipo',
                                            $tipos,
                                            null,
                                            ['class' => 'form-control', 'required'=>true, 'autocomplete' => 'off']
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('categoria_id', 'Categoria') !!}
                                        {!! Form::select(
                                            'categoria_id',
                                            $categorias,
                                            null,
                                            ['class' => 'form-control', 'required'=>true, 'autocomplete' => 'off']
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('data', 'Data do Movimento') !!}
                                            <span class="text-danger">*</span>
                                        {!! Form::text(
                                            'data',
                                            null,
                                            [
                                                'class' => 'form-control isDateFormat',
                                                'required'=>true,
                                                'autocomplete' => 'off'
                                            ]
                                        ) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('descricao', 'Descrição') !!}
                                        {!! Form::text(
                                            'descricao',
                                            null,
                                            ['class' => 'form-control', 'required'=>false, 'autocomplete' => 'off']
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('valor', 'Valor') !!}
                                        {!! Form::text(
                                            'valor',
                                            null,
                                            [
                                                'class' => 'form-control isMoneyConvert',
                                                'required'=>false,
                                                'autocomplete' => 'off'
                                            ]
                                        )!!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('membro_id', 'Membro') !!}
                                        {!! Form::select(
                                            'membro_id',
                                            $membros,
                                            null,
                                            [
                                                'class' => 'form-control',
                                                'required'=>false,
                                                'autocomplete' => 'off'
                                            ]
                                        )!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4">
                                    <label class="" for="">Comprovante</label>
                                    <div class="custom-file mb-2">
                                        <input type="file"
                                            class="custom-file-input"
                                            id="path_comprovante"
                                            name="path_comprovante"
                                        >
                                        <label class="custom-file-label" for="path_comprovante">
                                            Escolher o Arquivo
                                        </label>
                                    </div>
                                    @if(isset($model) && $model->path_comprovante)
                                    <a href="{{$model->path_comprovante}}" class="btn-link" target="_blank">
                                        <i class="fas fa-external-link-alt"></i> Abrir Comprovante
                                    </a>
                                    @endif
                                </div>
                            </div>

                            <button class="btn btn-success">
                                <i class='fas fa-save'></i>
                                {{(isset($model) ? 'Atualizar' : 'Cadastrar')}}
                            </button>
                            <a href="{{ route('area-tesouraria.movimentos.index') }}" class="btn btn-default" >
                                <i class="fas fa-arrow-left"></i>
                                Voltar
                            </a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
</script>
@endpush

