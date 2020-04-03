<?php
include_once "header.php";
include_once "Page Parts\CalenderScript.php";
include_once "Page Parts\\newActivityForm.php";
include_once "Page Parts\TopBar.php";
?>
<body>
<h2 align="center">Sleeps and Events</h2>
<br />
<div class="container">
  <div id="calendar"></div>
</div>
<div class="form-popup" id="newActivityForm">
    <form class="form-container" action="POST">
        <h1>New Activity</h1>

        <label for="title"><b>Title</b></label>
        <input type="text" placeholder="Enter Title" name="title" required>

        <label for="startDate"><b>Start Time</b></label>
        <input id= "startTime" type="datetime-local" name="startTime" required>

        <label for="endDate"><b>End Time</b></label>
        <input id= "endTime" type="datetime-local" name="endTime" required>

        <button type="submit" class="btn" onclick=<?php $db->InsertEvent(0,$_POST["title"],$_POST["startTime"],$_POST["endTime"]);?> >Add Activity</button>
        <button type="button" class="btn cancel" onclick="closeActivityForm()">Close</button>
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


