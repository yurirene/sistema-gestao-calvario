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
                            {!! Form::open([
                                'url' => route('usuarios.store'),
                                'method' => 'POST'
                            ]) !!}
                            @else
                            {!! Form::model($model, [
                                'url' => route('usuarios.update', $model->id),
                                'method' => 'PUT'
                            ]) !!}
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Nome') !!}<span class="text-danger">*</span>
                                        {!! Form::text('name', null, [
                                            'class' => 'form-control',
                                            'required'=>true,
                                            'autocomplete' => 'off'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('email', 'E-mail') !!}<span class="text-danger">*</span>
                                        {!! Form::text('email', null, [
                                            'class' => 'form-control',
                                            'required'=>true,
                                            'autocomplete' => 'off'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('password', 'Senha') !!}
                                        {!! Form::password('password', [
                                            'class' => 'form-control',
                                            'step' => '1',
                                            'min' => '0',
                                            'autocomplete' => 'off'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                @foreach($modulos as $key => $modulo)
                                <div class="col-md-3 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="modulo"
                                            id="check{{$key}}"
                                            value="{{ $modulo['id'] }}"
                                            data-toggle="toggle"
                                            data-on="<i class='fa fa-check'></i>"
                                            data-off="<i class='fa fa-times'></i>"
                                            data-onstyle="success"
                                            data-offstyle="danger"
                                            data-size="mini"
                                            {{ $modulo['ativo'] ? 'checked' : '' }}>
                                        <label class="form-check-label ml-2" for="check{{$key}}">
                                            {{ $modulo['nome'] }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button class="btn btn-success">
                                <i class='fas fa-save'></i>
                                {{(isset($model) ? 'Atualizar' : 'Cadastrar')}}
                            </button>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-default" >
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
$('input[name="modulo"]').on('change', function () {
    let valor = $(this).val();
    let usuario = "{{ $model->id }}";
    $.ajax({
        url: '{{route("usuarios.sync-permissao")}}',
        type: 'POST',
        data: {
            user_id : usuario,
            modulo_id: valor,
            ativado: $(this).prop('checked') ? 1 : 0,
            _token: "{{ csrf_token() }}"
        },
        success: function() {
            toastr.success('Permissão atualizada')
        },
        error: function () {
            toastr.error('Erro ao realizar operação')
        }
    })
})
</script>
@endpush
