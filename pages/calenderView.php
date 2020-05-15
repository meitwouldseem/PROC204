<?php
include_once "header.php";

if (!isset($_SESSION["UserID"]))
{
    header("Location: LogIn.php");
    die();
}
if( isset($_POST["EventTitle"]) && isset($_POST["EventStart"])  && isset($_POST["EventEnd"])) {
    $db->InsertEvent($_SESSION["UserID"], $_POST["EventTitle"],$_POST["EventStart"], $_POST["EventEnd"]);
}
?>
<head>
<script>
$(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
        editable:false,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },

        events: 'CalenderEndpoint/load.php',
        displayEventTime:true,
        displayEventEnd:true,
        selectable:true,
        selectHelper:true,
        aspectRatio: 2.2,
        select: function openNewActivity(){
            document.getElementById("newActivityForm").style.display = "block";
        },

        eventClick:function(event)
        {
            console.log(event);
            if(confirm("Are you sure you want to remove this record?"))
            {
                console.log("Doing the thing.");
                var id = event.id;
                $.ajax({
                    url:"CalenderEndpoint/delete.php",
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
<link rel="stylesheet" href="../css/ActivityForm.css">
</head>
<body class="lightbody">
<?php include "Page Parts/TopBar.php"; ?>
<h2 align="center" class ="title">Sleeps and Events</h2>
<br />
<div class="container">
  <div id="calendar"></div>
</div>
<div class="form-popup" id="newActivityForm">
    <form class="form-container" method="post" action="calenderView.php">
        <h1 class="title">New Activity</h1>

        <label for="title"><b>Title</b></label>
        <input type="text" placeholder="Enter Title" name="EventTitle" required>

        <label for="startDate"><b>Start Time</b></label>
        <input id= "startTime" type="datetime-local" name="EventStart" required>

        <label for="endDate"><b>End Time</b></label>
        <input id= "endTime" type="datetime-local" name="EventEnd" required>

        <input class="btn input" name="Submit" type="submit" value="Add Activity">

        <button type="button" class="btn cancel input" onclick="closeActivityForm()">Close</button>
        <script>
            var string = new Date().toISOString().substring(0, 16);
            document.getElementById("startTime").value = string;
            document.getElementById("endTime").value = string;
        </script>
    </form>
</div>

<script>
    function closeActivityForm(){
        document.getElementById("newActivityForm").style.display = "none";
    }
</script>
</body>
</html>


