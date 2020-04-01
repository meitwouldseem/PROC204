<?php
 include_once "Page Parts\TopBar.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sleeps and Events</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="~/lib/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="~/css/site.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="~/css/site.min.css"  />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>

    $(document).ready(function() {
      var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
          left:'prev,next today',
          center:'title',
          right:'month,agendaWeek,agendaDay'
        },
        events: 'load.php',
        selectable:true,
        selectHelper:true,
        select: function(start, end, allDay)
        {
          var title = prompt("Enter Event Title");
          if(title)
          {
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
            $.ajax({
              url:"insert.php",
              type:"POST",
              data:{title:title, start:start, end:end},
              success:function()
              {
                calendar.fullCalendar('refetchEvents');
                alert("Added Successfully");
              }
            })
          }
        },
        editable:true,
        eventResize:function(event)
        {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
          var title = event.title;
          var id = event.id;
          $.ajax({
            url:"update.php",
            type:"POST",
            data:{title:title, start:start, end:end, id:id},
            success:function(){
              calendar.fullCalendar('refetchEvents');
              alert('Event Update');
            }
          })
        },

        eventDrop:function(event)
        {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
          var title = event.title;
          var id = event.id;
          $.ajax({
            url:"update.php",
            type:"POST",
            data:{title:title, start:start, end:end, id:id},
            success:function()
            {
              calendar.fullCalendar('refetchEvents');
              alert("Event Updated");
            }
          });
        },

        eventClick:function(event)
        {
          if(confirm("Are you sure you want to remove it?"))
          {
            var id = event.id;
            $.ajax({
              url:"delete.php",
              type:"POST",
              data:{id:id},
              success:function()
              {
                calendar.fullCalendar('refetchEvents');
                alert("Event Removed");
              }
            })
          }
        },

      });
    });

  </script>
</head>
<body>
<br />
<h2 align="center">Sleeps and Events</h2>
<br />
<div class="container">
  <div id="calendar"></div>
</div>
</body>
</html>


