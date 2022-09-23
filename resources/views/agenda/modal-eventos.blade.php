<div class="modal" id="modal-registro-evento" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="titulo-modal" class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="evento-form">
                <div class="modal-body">
                    <div class="row">
                        <div class="mensagem col-md-12 mb-2"></div>

                        <input type="hidden" name="id" id="id">
                        <div class="mb-3 col-md-12">
                            {!! Form::label('titulo', 'Título') !!}
                            {!! Form::text('titulo', null, ['class' => 'form-control',  'id' => 'titulo', 'required']) !!}
                        </div>
                        <div class="mb-3 col-md-6">
                            {!! Form::label('inicio', 'Data Inicial') !!}
                            {!! Form::text('inicio', null, ['class' => 'form-control isDateTime', 'style' => 'width:100%', 'id' => 'inicio', 'required', 'minlength' => 19]) !!}
                        </div>
                        <div class="mb-3 col-md-6">
                            {!! Form::label('final', 'Data Final') !!}
                            {!! Form::text('final', null, ['class' => 'form-control isDateTime', 'style' => 'width:100%', 'id' => 'final', 'required', 'minlength' => 19]) !!}
                        </div>
                        <div class="mb-3 col-md-12">
                            {!! Form::label('cor', 'Cor') !!}
                            {!! Form::select('cor', [], null, ['class' => 'form-control', 'style' => 'width:100%', 'id' => 'cor', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger deleteEvent">Excluir</button>
                    <button type="button" class="btn btn-primary saveEvent">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('css')
<style>


#select2-cor-container {
        margin-top: -11px !important;
        height: 25px !important;
    }
</style>
@endpush