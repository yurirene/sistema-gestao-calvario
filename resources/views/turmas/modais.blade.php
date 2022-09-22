
<div class="modal fade" id="addAluno" tabindex="-1" aria-labelledby="addAlunoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAlunoLabel">Adicionar Aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => route('turmas.alunos.incluir', $model->id), 'method' => 'POST']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('aluno_id', 'Aluno') !!}<span class="text-danger">*</span>
                            {!! Form::select('aluno_id', $membros, null, ['class' => 'form-control', 'placeholder' => '-', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success"><i class='fas fa-save'></i> Adicionar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade" id="addAula" tabindex="-1" aria-labelledby="addAulaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAulaLabel">Adicionar Aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => route('turmas.aulas.incluir', $model->id), 'method' => 'POST']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('data', 'Data') !!}<span class="text-danger">*</span>
                            {!! Form::text('data', null, ['class' => 'form-control isDate', 'required'=>true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('assunto', 'Assunto') !!}<span class="text-danger">*</span>
                            {!! Form::text('assunto', null, ['class' => 'form-control', 'required'=>true, 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('observacao', 'Observação') !!}
                            {!! Form::textarea('observacao', null, ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '3']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success"><i class='fas fa-save'></i> Adicionar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="editarAula" tabindex="-1" aria-labelledby="editAulaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAulaLabel">Atualizar Aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-edit" method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('data', 'Data') !!}<span class="text-danger">*</span>
                                {!! Form::text('data', null, ['class' => 'form-control isDate', 'required'=>true, 'autocomplete' => 'off', 'id' => 'data_edit']) !!}
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                {!! Form::label('assunto', 'Assunto') !!}<span class="text-danger">*</span>
                                {!! Form::text('assunto', null, ['class' => 'form-control', 'required'=>true, 'autocomplete' => 'off', 'id' => 'assunto_edit']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('observacao', 'Observação') !!}
                                {!! Form::textarea('observacao', null, ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '3', 'id' => 'observacao_edit']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success"><i class='fas fa-save'></i> Atualizar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="frequenciaAula" tabindex="-1" aria-labelledby="editAulaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAulaLabel">Atualizar Frequência</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-frequencia" method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Aula </label>
                            <input type="text" class="form-control" id="assunto-frequencia" disabled />
                        </div>
                    </div>
                    <h5 class="text-center mt-3">Frequência</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td class="text-center">
                                            <input class="form-check-input" id="check-master" type="checkbox">
                                        </td>
                                        <td>Aluno</td>
                                    </tr>
                                </thead>
                                <tbody  id="corpo">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success"><i class='fas fa-save'></i> Atualizar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>