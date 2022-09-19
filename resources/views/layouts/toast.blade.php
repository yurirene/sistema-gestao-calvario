@if ($errors->any())
    @foreach ($errors->all() as $error)
    <script>
        toastr.error('{{$error}}', 'Erro!')
    </script>
    @endforeach
@endif
@if (session('error-validation'))
    @foreach (session('error-validation') as $error)
    <script>
        toastr.error('{{$error[0]}}', 'Erro!')
    </script>
    @endforeach
    @php
    session()->forget('error-validation')
    @endphp
@endif

@if (session('mensagem'))
    @if(session('mensagem')['tipo'] == 'success')
    <script>
        toastr.success("{{session('mensagem')['mensagem']}}", 'Tudo Certo!')
    </script>
    @else
    <script>
        toastr.error('{{session("mensagem")["mensagem"]}}', 'Erro!')
    </script>
    @endif
@endif
