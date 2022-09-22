<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        Ações
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <button 
            class="dropdown-item" 
            onclick="deleteRegistro('{{ route('turmas.aulas.excluir', ['model' => $turma, 'aula' => $id]) }}')"
        >Apagar</button>
        <button 
            class="dropdown-item" 
            data-route="{{ route('turmas.aulas.update', ['model' => $turma, 'aula' => $id]) }}" 
            data-aula="{{ $informacao }}" 
            data-toggle="modal" 
            data-target="#editarAula"
        >Editar</button>

        <button 
            class="dropdown-item" 
            data-route="{{ route('turmas.aulas.frequencia.update', ['model' => $turma, 'aula' => $id]) }}" 
            data-routeget="{{ route('turmas.aulas.frequencia', ['model' => $turma, 'aula' => $id]) }}" 
            data-aula="{{$aula}}"
            data-toggle="modal" 
            data-target="#frequenciaAula"
        >Frequência</button>
    </div>
</div>
