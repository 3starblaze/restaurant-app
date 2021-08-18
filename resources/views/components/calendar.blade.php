<div id="calendar" {{ $attributes }}></div>
<script>
 document.addEventListener('DOMContentLoaded', function() {
     var calendarEl = document.getElementById('calendar');
     var calendar = new FullCalendar.Calendar(calendarEl, {
         initialView: 'dayGridMonth',
         selectable: true,
         select(info) {
             console.log(info.start); // It WORKS!
             Livewire.emit('selected', info.start);
         },
         headerToolbar: {
             left: '',
             center: 'title',
             right: 'prev,next',
         },
     });
     calendar.render();
 });
</script>
