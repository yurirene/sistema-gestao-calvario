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
                <span class="info-box-number">410</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-12">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fas fa-user-graduate"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Alunos EBD</span>
                <span class="info-box-number">410</span>
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
                <canvas id="myChart"></canvas>
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
        const DATA_COUNT = 7;
        const NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

        const labels =['A', 'B', 'C', 'D', 'E', 'F'];
        const data = {
        labels: labels,
        datasets: [
            {
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 2,
                borderRadius: 5,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.9)',
                    'rgba(54, 162, 235, 0.9)',
                    'rgba(255, 206, 86, 0.9)',
                    'rgba(75, 192, 192, 0.9)',
                    'rgba(153, 102, 255, 0.9)',
                    'rgba(255, 159, 64, 0.9)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
            {
                label: 'Dataset 2',
                data: [5, 2, 12, 5, 5, 1],
                backgroundColor: ['rgba(255, 99, 132, 0.9)'],
                borderColor: ['rgba(255, 99, 132, 1)'],
                type: 'line',
                order: 0
            }
        ]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Combined Line/Bar Chart'
                }
                }
            },
        };

        const myChart = new Chart(ctx, config);
        </script>
        
@endsection
