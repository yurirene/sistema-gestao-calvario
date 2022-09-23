@extends('layouts.template')

@section('title', 'Turma')

@section('content_header')
    <h1>Turma</h1>
@stop

@section('content')
<div class="row mb-3">
    <div class="col-md-3 col-sm-3 col-12">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-book-reader"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Turma</span>
                <span class="info-box-number">{{ $model->nome }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-12">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fas fa-user-graduate"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Nº Alunos</span>
                <span class="info-box-number">{{ $model->alunos->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-12">
        <div class="info-box bg-secondary">
            <span class="info-box-icon"><i class="fas fa-chalkboard-teacher"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Professor(a)</span>
                <span class="info-box-number">{{ $model->professor->nome }}</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="card card-outline card-primary h-100">
            <div class="card-header">
                Alunos
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addAluno">
                            <i class="fas fa-plus"></i> Adicionar Aluno
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="alunos-table" class="table">
                            <thead>
                                <tr>
                                    <th>Ação</th>
                                    <th>Aluno</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card card-outline card-primary h-100">
            <div class="card-header">
                Aulas
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addAula">
                            <i class="fas fa-plus"></i> Adicionar Aula
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="aulas-table" class="table">
                            <thead>
                                <tr>
                                    <th>Ação</th>
                                    <th>Data</th>
                                    <th>Assunto</th>
                                    <th>Presentes</th>
                                    <th>Observação</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('turmas.modais')
@stop

@section('css')
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var urlAlunos = '{{ route("turmas.alunos.datatable", $model->id) }}';
        const datatableAlunos = $('#alunos-table').DataTable({
            dom: 'frtp',
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: urlAlunos,
            columns: [
                {data: 'acao'},
                {data: 'nome'},
            ]
        });
        var urlAulas = '{{ route("turmas.aulas.datatable", $model->id) }}'
        const datatableAulas = $('#aulas-table').DataTable({
            dom: 'frtp',
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: urlAulas,
            columns: [
                {data: 'acao'},
                {data: 'data'},
                {data: 'assunto'},
                {data: 'presentes'},
                {data: 'observacao'},
            ]
        });

        $('#editarAula').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var route = button.data('route');
            var informacoes = button.data('aula');
            
            var modal = $(this)
            
            
            modal.find('#data_edit').val(informacoes.data);
            modal.find('#assunto_edit').val(informacoes.assunto);
            modal.find('#observacao_edit').val(informacoes.observacao);
            modal.find('#form-edit').attr('action', route);
        });
        $('#frequenciaAula').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var route = button.data('route');
            var route_get = button.data('routeget');
            var aula = button.data('aula');
            var modal = $(this)

            modal.find('#corpo').empty();
            

            $.ajax({
                url : route_get
            }).done((response) => {
                response.forEach((item) => {
                    let alunos_html = '';
                    alunos_html += `<tr>
                        <td class="text-center">
                            <input class="form-check-input isCheck" name="presentes[]" type="checkbox" value="${item.id}" ${item.presente ? 'checked' : ''}>
                        </td>
                        <td>
                            ${item.nome}
                        </td>
                    </tr>`;
                    modal.find('#corpo').append(alunos_html);
                });
                
            });            
            modal.find('#assunto-frequencia').val(aula);
            modal.find('#form-frequencia').attr('action', route);
        });
        
    });


    $(document).on('click','#check-master', function(){
        $('.isCheck').prop('checked', $(this).prop('checked'));
    });
    
</script>
@endpush