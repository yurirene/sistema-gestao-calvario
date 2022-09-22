<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        Ações
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <button class="dropdown-item" href="#" onclick="deleteRegistro('{{ route('turmas.alunos.excluir', ['model' => $turma, 'aluno' => $id]) }}')">Apagar</button>
    </div>
</div>
