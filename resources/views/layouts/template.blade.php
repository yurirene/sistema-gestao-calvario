@extends('adminlte::page')


@section('css')

<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

<style>
    .form-checkbox {
        height: 17px !important;
    }
    .select2-selection__rendered {
        line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
        height: 35px !important;
    }
    .select2-selection__arrow {
        height: 34px !important;
    }

    .fc-toolbar.fc-header-toolbar {
        display: flex;
        flex-direction: column;
    }
    .fc-toolbar.fc-header-toolbar .fc-left {
        order: 3;
    }
    .fc-toolbar.fc-header-toolbar .fc-center {
        order: 1;
    }
    .fc-toolbar.fc-header-toolbar .fc-right {
        order: 2;
    }
    .card-body-rolagem { height: 300px; overflow-x: scroll; width: 100%; }
</style>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

@endsection

@push('js')


<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.2/b-2.0.0/b-html5-2.0.0/b-print-2.0.0/datatables.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session()->has('mensagem') && session('status') == true)
<script>toastr.success('{{session("mensagem")}}'); </script>
@elseif(session()->has('mensagem') && session('status') == false)
<script>toastr.error('{{session("mensagem")}}'); </script>
@endif

<link href="/assets/css/toggle/bootstrap-toggle.min.css" rel="stylesheet">
<script src="/assets/js/toggle/bootstrap-toggle.min.js"></script>

<script>


    @if ($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}');
    @endforeach
    @endif

    function deleteRegistro(url) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Deseja apagar o registro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }

</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js" integrity="sha512-mVkLPLQVfOWLRlC2ZJuyX5+0XrTlbW2cyAwyqgPkLGxhoaHNSWesYMlcUjX8X+k45YB8q90s88O7sos86636NQ==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<link rel="stylesheet" href="/assets/js/fullcalendar/main.min.css">
<script src='/assets/js/fullcalendar/main.min.js'></script>
<script src='/assets/js/fullcalendar/main.global.min.js'></script>


<script src='{{asset('assets/js/chartjs/chart.min.js')}}'></script>

<script>


    $('.isSelect2Creatable').select2({
        tags: true
    });


    $('.isSelect2').select2({
        theme: "classic"
    });

    $('.isMoney').mask('000,000,000', {reverse: true});
    $('.isDateFormat').mask('00/00/0000');
    $('.isCelular').mask('(00)00000-0000');
    $('.isAno').mask('0000');

    $('.isMoneyConvert').mask('000.000.000.000,00', {reverse: true});

    $('.isDate:not([readonly])').datepicker({
        language: "pt-BR",
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy'
    });

    // Mascara de CPF e CNPJ
    var CpfCnpjMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
    },
    cpfCnpjpOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
        }
    };

    $(function() {
        $('.cpfcnpj').mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);
    })

    $('.isDateRange').daterangepicker({
        autoUpdateInput: false,
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "daysOfWeek": [
            "Dom",
            "Seg",
            "Ter",
            "Qua",
            "Qui",
            "Sex",
            "Sab"
            ],
            "monthNames": [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro"
            ],
            "firstDay": 1
        }
    }, function(start_date, end_date) {
        this.element.val(start_date.format('DD/MM/YYYY')+' - '+end_date.format('DD/MM/YYYY'));
    });
</script>


@yield('script_fim')

@endpush
