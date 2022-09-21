@extends('layouts.template')

@section('title', 'Agenda')

@section('content_header')
    <h1>Agenda</h1>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div id='calendar'
                                        data-route-event-index={{ route('eventos.index') }}
                                        data-route-event-store={{ route('eventos.store') }}
                                        data-route-event-update={{ route('eventos.update') }}
                                        data-route-event-delete={{ route('eventos.destroy') }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('agenda.modal-eventos')
                    </div>
                    
                    @push('js')
                        <script src='{{asset('assets/js/agenda/fullcalendar.js')}}'></script>
                        <script src='{{asset('assets/js/agenda/scripts.js')}}'></script>
                        <script>
                            document.addEventListener('atualizarCalendarioComUsuario', event => {
                                objCalendar.refetchEvents();
                            });
                            
                        </script>
                    @endpush
                    
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@endsection

@push('js')
@endpush