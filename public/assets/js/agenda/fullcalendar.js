document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap4',
        locale: 'pt-br',
        eventColor: '#378006',
        events: routeEvents('routeEventIndex'),
        eventDisplay: 'block',
        eventLimit: true,
        selectable: true,
        editable: true,
        droppable: true,
        fixedWeekCount: false,
        showNonCurrentDates: false,
        select: function(element) {
            $('#modal-registro-evento').modal('show');
            clearMessages(".mensagem");
            resetForm('#evento-form');

            $('#titulo-modal').text('Inserir Evento');
            $('button.deleteEvent').css('display', 'none');

            $("#id").val(null);
            $("#titulo").val(null);
            $("#cor").val("#435ebe").trigger('change');
            $("#inicio").val(moment(element.start).format("DD/MM/YYYY HH:MM"));
            $("#final").val(moment(element.end).format("DD/MM/YYYY HH:MM"));
        },

        eventClick: function(element) {
            clearMessages(".mensagem");
            resetForm('#evento-form');

            $('#modal-registro-evento').modal('show');
            $('#titulo-modal').text('Alterar Evento');
            $('button.deleteEvent').css('display', 'flex');

            $("#id").val(element.event.id);
            $("#titulo").val(element.event.title);
            $("#inicio").val(moment(element.event.start).format("DD/MM/YYYY HH:MM"));
            $("#final").val(moment(element.event.end).format("DD/MM/YYYY HH:MM"));
            $("#cor").val(element.event.backgroundColor).trigger('change');

        },

        eventResize: function(element) {
            console.log('aa');
            let start = moment(element.event.start).format("DD/MM/YYYY HH:MM");
            let end = moment(element.event.end).format("DD/MM/YYYY HH:MM");

            let newEvent = {
                _method: 'PUT',
                id: element.event.id,
                inicio: start,
            };

            sendEvent(routeEvents('routeEventUpdate'), newEvent);
        },

        eventReceive: function (element) {
            console.log('bba');
            element.event.remove();
        },

        eventDrop: function(element) {
            console.log('cc');
            let start = moment(element.event.start).format("DD/MM/YYYY HH:MM");
            let end = moment(element.event.end).format("DD/MM/YYYY HH:MM");

            let newEvent = {
                _method: 'PUT',
                id: element.event.id,
                titulo: element.event.title,
                inicio: start,
                final: end,
                cor: element.event.backgroundColor,
            };

            sendEvent(routeEvents('routeEventUpdate'), newEvent);
        },

        drop: function(element) {
            console.log('dd');
            let Event = JSON.parse(element.draggedEl.dataset.event);

            let start = moment(`${element.dateStr} ${Event.start}`).format("DD/MM/YYYY HH:MM");
            let end = moment(`${element.dateStr} ${Event.end}`).format("DD/MM/YYYY HH:MM");

            Event.titulo = element.event.title;
            Event.inicio = start;
            Event.final = end;
            Event.cor = element.event.backgroundColor;

            delete Event.id;
            delete Event._method;

            sendEvent(routeEvents('routeEventStore'), Event);
        },
    });
    objCalendar = calendar;

    calendar.render();
});
