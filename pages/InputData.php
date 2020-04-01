<?php

include_once "header.php";
include_once "Page Parts\TopBar.php";
?>

<body>


    <div class="container">
        <main role="main" class="pb-3">
        </main>
    </div>

</body>
</html>



<div class="container">
    <form  method="post">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-3">
                <h1 class="text-right" style="color:#FFFFFF">Sleep start</h1>
                <input type="datetime-local" id="datetime"
                       name="SleepStart"
                       style="float:right; clear:both">
            </div>
            <div class="col-3">
                <h1 class="text-left" style="color:#FFFFFF">Wake up</h1>
                <input type="datetime-local" id="datetime"
                       name="SleepEnd">
            </div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="input-group input-group-sm mb-3 col-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">User ID</span>
                </div>
                <input type="text" class="form-control" name="ID">
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <input class="btn btn-primary" name="Submit" type="submit" value="Submit">
            </div>
            <div class="col-4"></div>
        </div>
        <script>
            var string = new Date().toISOString().substring(0, 16);
            document.getElementById("datetime").value = string;
        </script>
    </form>
</div>
