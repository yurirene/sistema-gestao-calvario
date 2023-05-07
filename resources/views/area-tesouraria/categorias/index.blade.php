@extends('layouts.template')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
<div class="row mb-3">
    <div class="col">
        <button class="btn btn-primary">
            Nova Categoria
        </button>
    </div>
</div>
<div class="row">
    @foreach($categorias as $categoria)
    <div class="col-md-6 mb-3">
        <div class="card card-outline card-primary h-100">
            <div class="card-header">
                <div class=" d-flex justify-content-between align-items-center">
                    {{$categoria['nome']}}
                    <div>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body card-body-rolagem">
                <table class="table" aria-label="description">
                    <tr>
                        <th>#</th>
                        <th>Subcategoria</th>
                    </tr>
                    @foreach($categoria['subcategorias'] as $idSubcategoria => $nome)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle"
                                    type="button" data-toggle="dropdown" aria-expanded="false"
                                >
                                    Ações
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item"
                                        href="#">
                                        Editar
                                    </a>
                                    <button class="dropdown-item" href="#"
                                        onclick="deleteRegistro(
                                            '{{ route('area-tesouraria.subcategorias.delete', $idSubcategoria) }}'
                                        )"
                                    >
                                        Apagar
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>{{ $nome }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @endforeach

</div>
@stop
@section('script_fim')

@endsection
