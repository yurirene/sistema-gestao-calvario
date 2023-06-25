@extends('layouts.template')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
<div class="row">
    @foreach($tipos as $key => $tipo)
    <div class="col-md-6 mb-3">
        <div class="card card-outline card-primary h-100">
            <div class="card-header">
                <div class=" d-flex justify-content-between align-items-center">
                    {{$tipo}}
                    <div>
                        <div class="dropdown">
                            <button class="btn btn-xs dropdown-toggle "
                                type="button" data-toggle="dropdown" aria-expanded="false"
                            >
                                <i class="fas fa-cogs"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                <a class="dropdown-item"
                                    data-toggle="modal"
                                    data-target="#modalCadastro"
                                    data-tipo="{{$key}}"
                                    data-route="{{route('area-tesouraria.categorias.store')}}"
                                >
                                    Nova Categoria
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body card-body-rolagem">
                <table class="table" aria-label="description">
                    <tr>
                        <th>#</th>
                        <th>Categoria</th>
                    </tr>
                    @foreach($categorias[$key] as $categoria)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-xs dropdown-toggle"
                                    type="button" data-toggle="dropdown" aria-expanded="false"
                                >
                                    Ações
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" data-toggle="modal"
                                        data-target="#modalEditar" href="#"
                                        data-id="{{$categoria['id']}}"
                                        data-nome="{{$categoria['nome']}}"
                                        data-route="{{route('area-tesouraria.categorias.update', $categoria['id'])}}"
                                    >
                                        Editar
                                    </a>
                                    <button class="dropdown-item" href="#"
                                        onclick="deleteRegistro(
                                            '{{ route('area-tesouraria.categorias.delete', $categoria['id']) }}'
                                        )"
                                    >
                                        Apagar
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>{{ $categoria['nome'] }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>
@include('area-tesouraria.modal-editar')
@stop
