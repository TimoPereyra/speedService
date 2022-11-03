document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('agenda');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: "es",  /*idioma*/
        headerToolbar:{
            /*barra de herramientas*/
            left:'prev,next,today',
            center:'title',
            right:'dayGridMonth,timeGridWeek,timeGridDay'
        },
        dateClick: function (info){
            console.log(info.dateStr);
            window.location.href = 'listServiDia.php?fecha='+info.dateStr+'';
        }
    });
    
    calendar.render();
});