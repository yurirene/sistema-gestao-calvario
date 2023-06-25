
<div class="modal fade" id="modalEditar"
    tabindex="-1"
    role="dialog"
    aria-labelledby="titlemodal"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titlemodal">Editar Categoria</h5>
                <button type="button" class="close"
                    data-dismiss="modal" aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open([
                'method' => 'PUT',
                'id' => 'form-edit'
            ]) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::text('nome', null, [
                            'class' => 'form-control',
                            'required' => 'required',
                            'id' => 'nome_edit'
                    ]) !!}
                </div>
                <input type="hidden" name="id" id="id_edit">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="modalCadastro"
    tabindex="-1"
    role="dialog"
    aria-labelledby="titlemodal"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titlemodal">Nova Categoria</h5>
                <button type="button" class="close"
                    data-dismiss="modal" aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open([
                'method' => 'POST',
                'id' => 'form-create'
            ]) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::text('nome', null, [
                            'class' => 'form-control',
                            'required' => 'required',
                            'id' => 'nome_create'
                    ]) !!}
                </div>
            </div>
            <input type="hidden" name="tipo" id="tipo">

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@push('js')

<script>
$('#modalEditar').on('shown.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    let route = button.data('route');
    let id = button.data('id');
    let nome = button.data('nome');

    let modal = $(this)


    modal.find('#id_edit').val(id);
    modal.find('#nome_edit').val(nome);
    modal.find('#form-edit').attr('action', route);
});

$('#modalCadastro').on('shown.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    let route = button.data('route');
    let tipo = button.data('tipo');
    let categoria = button.data('categoria')
    let modal = $(this)


    modal.find('#nome_create').val('');
    modal.find('#tipo').val(tipo);
    modal.find('#form-create').attr('action', route);
});

</script>
@endpush
