<?php
$calenderData = $db->GetUsersCalenderData(0);
?>

<head>
<script>

$(document).ready(function() {
  var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },
    events: <?php echo json_encode($calenderData)?>,
    selectable:true,
    selectHelper:true,
      aspectRatio: 2.1,
    select: function(start, end, allDay)
    {
      var title = prompt("Enter Event Title");
      if(title)
      {
        start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
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
        data:{title:title, start:start, end:end},
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