<?php

include_once "header.php";

if (!isset($_SESSION["UserID"]))
{
    header("Location: LogIn.php");
    die();
}

if( isset($_POST["SleepStart"]) && isset($_POST["SleepEnd"])  && isset($_POST["Rating"])) {
    if(strtotime($_POST["SleepStart"])<strtotime($_POST["SleepEnd"])) {
        if(0<$_POST["Rating"] && $_POST["Rating"]<6) {
            $db->InsertSleepDatum($_SESSION["UserID"], $_POST["SleepStart"], $_POST["SleepEnd"], $_POST["Rating"]);
            header("Location: InputData.php");
            return;
        } else {
            echo "<script> window.onload = function () {window.alert(\"The sleep rating must be between 1-5\")} </script>";
        }
    } else {
        echo "<script> window.onload = function () {window.alert(\"The sleep start must be less than sleep end\")} </script>";
    }
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
        <?php include "Page Parts/TopBar.php"; ?>
    </div>
    <div class="container">
        <main role="main" class="pb-3">
        </main>
    </div>
    <div class="container">
        <form  method="post" action="InputData.php">
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-3">
                    <h1 class="text-right title">Sleep start</h1>
                    <input type="datetime-local" id="start"
                           name="SleepStart" class="input"
                           style="float:right; clear:both">
                </div>
                <div class="col-3">
                    <h1 class="text-left title">Wake up</h1>
                    <input type="datetime-local" id="end"
                           name="SleepEnd" class="input">
                </div>
            </div>
            <div class="row">
                <div class="col-5"></div>
                <div class="input-group input-group-sm mb-3 col-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text input" id="rate">On a scale from 1 to 5 how did you feel when you woke up?</span>
                    </div>
                    <input type="number" min="1" max="5" value="3" class="input" name="Rating" style="align-self: center">
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

