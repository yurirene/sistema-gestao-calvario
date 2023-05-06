@extends('layouts.template')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row mb-3">
    <div class="col-md-3 col-sm-3 col-12">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Nº de Membros</span>
                <span class="info-box-number">{{ $totalizadores['membros'] }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-12">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fas fa-user-graduate"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Alunos EBD</span>
                <span class="info-box-number">{{ $totalizadores['alunos'] }}</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <div class="card card-outline card-primary h-100">
            <div class="card-header">
                Frequência
            </div>
            <div class="card-body">
                <canvas id="myChart" height="400px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-outline card-primary h-100">
            <div class="card-header">
                Agenda
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id='calendar'
                            data-route-event-index={{ route('eventos.index') }}
                            data-route-event-store={{ route('eventos.store') }}
                            data-route-event-update={{ route('eventos.update') }}
                            data-route-event-delete={{ route('eventos.destroy') }}>
                        </div>
                    </div>
                    @include('agenda.modal-eventos')
                </div>                
            </div>
        </div>
    </div>
</div>
@stop
@section('script_fim')

    <script src='{{asset('assets/js/agenda/fullcalendar.js')}}'></script>
    <script src='{{asset('assets/js/agenda/pt-br.js')}}'></script>
    <script src='{{asset('assets/js/agenda/scripts.js')}}'></script>
    <script>
        document.addEventListener('atualizarCalendarioComUsuario', event => {
            objCalendar.refetchEvents();
        });
        
    </script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        
        
        const config = {
            type: 'bar',
            data: @json($grafico_frequencia),
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Gráfico de Frequência de Membros e Visitantes'
                    }
                }
            },
            yAxis: {
                min: 0,
                max: 140,
                tickInterval: 5,
                lineColor: '#FF0000',
                lineWidth: 1,
                title: {
                    text: 'Vassslues'
    
                }
            },
        };

        const myChart = new Chart(ctx, config);
        </script>
        
@endsection
