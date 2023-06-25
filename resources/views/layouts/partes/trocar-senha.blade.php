
<div class="modal fade" id="modalTrocarSenha"
    tabindex="-1"
    role="dialog"
    aria-labelledby="titlemodal"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titlemodal">Trocar Senha</h5>
                <button type="button" class="close"
                    data-dismiss="modal" aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open([
                'method' => 'POST',
                'route' => 'comum.trocar-senha'
            ]) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('senhaAntiga', 'Senha Antiga') !!}
                            {!! Form::password('senhaAntiga', [
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'autocomplete' => 'off'
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('novaSenha', 'Nova Senha') !!}
                            {!! Form::password('novaSenha', [
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'autocomplete' => 'off'
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
