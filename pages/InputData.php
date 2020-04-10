<?php

include_once "header.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/PROC204/classes/DBContext.php';

if( $_GET["SleepStart"] && $_GET["SleepEnd"] && $_GET["ID"] ) {
    InsertSleepDatum(1, $_GET["ID"], $_GET["SleepStart"],$_GET["SleepEnd"], 1);
}
?>

<style>
    .input {
        background-color: #2c2f33;
        color: #FFFFFF;
        border-color: #2c2f33;
    }
</style>

<body style="background-color: #23272a">
    <div class="container">
        <nav class="navbar navbar-light navbar-fixed-top" style="background-color: #7289DA;">
            <form class="form-inline">
                <a class="btn btn-outline-white" role="button">Look at Data</a>
                <a class="btn btn-outline-white" role="button">Enter Data</a>
                <a class="btn btn-outline-white" role="button">Settings</a>
            </form>
        </nav>
        <h1></h1>
        <h2></h2>
    </div>

    <div class="container">
        <main role="main" class="pb-3">
        </main>
    </div>





    <div class="container">
        <form  method="post">
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-3">
                    <h1 class="text-right" style="color:#FFFFFF">Sleep start</h1>
                    <input type="datetime-local" id="start"
                           name="SleepStart" class="input"
                           style="float:right; clear:both">
                </div>
                <div class="col-3">
                    <h1 class="text-left" style="color:#FFFFFF">Wake up</h1>
                    <input type="datetime-local" id="end"
                           name="SleepEnd" class="input">
                </div>
            </div>
            <div class="row">
                <div class="col-5"></div>
                <div class="input-group input-group-sm mb-3 col-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text input" id="basic-addon1">User ID</span>
                    </div>
                    <input type="text" class="input" name="ID" style="align-self: center">
                </div>
                <div class="col-5"></div>
            </div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 text-center">
                    <input class="btn btn-primary" name="Submit" type="submit" value="Submit">
                </div>
                <div class="col-4"></div>
            </div>
            <script>
                var now = new Date();
                document.getElementById("start").value = new Date(now.valueOf() - 60000*480).toISOString().substring(0, 16);
                document.getElementById("end").value = now.toISOString().substring(0, 16);
            </script>
        </form>
    </div>

</body>

