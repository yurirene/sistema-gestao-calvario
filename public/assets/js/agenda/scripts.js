$(function () {
    var data = [
        {
            id: '#435ebe',
            text: '<span class="w-100 text-start badge bg-primary text-primary" style="margin-top:7px">#435ebe</span>',
            html: '<span class="w-100 text-start badge bg-primary text-primary">#435ebe</span>',
            title: '#435ebe'
        },
        {
            id: '#0dcaf0',
            text: '<span class="w-100 text-start badge bg-info text-info" style="margin-top:7px">#0dcaf0</span>',
            html: '<span class="w-100 text-start badge bg-info text-info">#0dcaf0</span>',
            title: '#0dcaf0'
        },
        {
            id: '#198754',
            text: '<span class="w-100 text-start badge bg-success text-success" style="margin-top:7px">#198754</span>',
            html: '<span class="w-100 text-start badge bg-success text-success">#198754</span>',
            title: '#198754'
        },
        {
            id: '#ffc107',
            text: '<span class="w-100 text-start badge bg-warning text-warning" style="margin-top:7px">#ffc107</span>',
            html: '<span class="w-100 text-start badge bg-warning text-warning">#ffc107</span>',
            title: '#ffc107'
        },
        {
            id: '#dc3545',
            text: '<span class="w-100 text-start badge bg-danger text-danger" style="margin-top:7px">#dc3545</span>',
            html: '<span class="w-100 text-start badge bg-danger text-danger">#dc3545</span>',
            title: '#dc3545'
        }
    ];

    $("#cor").select2({
        data: data,
        escapeMarkup: function(markup) {
            return markup;
        },
        templateResult: function(data) {
            return data.html;
        },
        templateSelection: function(data) {
            return data.text;
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.saveEvent').on('click', function () {
        let id = $("#id").val();
        let titulo = $("#titulo").val();
        let inicio = $("#inicio").val();
        let final = $("#final").val();
        let cor = $("#cor").val();

        let Event = {
            titulo: titulo,
            inicio: inicio,
            final: final,
            cor: cor,
        };

        let route;

        if (id == '') {
            route = routeEvents('routeEventStore');
        } else {
            route = routeEvents('routeEventUpdate');
            Event.id = id;
            Event._method = 'PUT';
        }

        sendEvent(route, Event);
    });

    $('.deleteEvent').click(function () {
        let id = $("#id").val();
        $("#titulo").prop('disabled', true);
        $("#inicio").prop('disabled', true);
        $("#final").prop('disabled', true);
        $("#cor").prop('disabled', true);

        let Event = {
            id: id,
            _method: 'DELETE'
        };

        let route = routeEvents('routeEventDelete');

        sendEvent(route, Event);

        location.reload();

        objCalendar.updateSize();
    });

    $('.closeModal').click(function () {
        $('#modal-registro-evento').modal('hide');
    });

    document.addEventListener('autualizarCalendario', event => {
        objCalendar.refetchEvents();
    })
});

function sendEvent(route, data_) {
    $.ajax({
        url: route,
        data: data_,
        method: 'POST',
        dataType: 'json',
        success: function (json) {
            if (json.success == true) {
                $(".mensagem").html('<div class="alert alert-success" role="alert">'+json.message+'</div>');
                objCalendar.refetchEvents();
                $('#modal-registro-evento').modal('hide');
            }
        },
        error: function (json) {
            let responseJSON = json.responseJSON.errors;
            $(".mensagem").html(loadErrors(responseJSON));
        }
    });
}

function loadErrors(response)
{
    let boxAlert = `<div class="w-100 p-2 badge bg-danger text-start"`;

    for (let fields in response) {
        boxAlert += `<span>${response[fields]}</span><br>`;
    }

    boxAlert += `</div>`;

    return boxAlert.replace(/\,/g, "<br/>");
}

function routeEvents(route)
{
    return document.getElementById('calendar').dataset[route];
}

function clearMessages(element)
{
    $(element).text('');
}

function resetForm(form)
{
    $(form)[0].reset();
    $("titulo").prop('disabled', false);
    $("#inicio").prop('disabled', false);
    $("#final").prop('disabled', false);
    $("#cor").prop('disabled', false);
    $(".saveFastEvent").prop('disabled', false);
}
