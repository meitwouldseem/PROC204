<?php

include_once "header.php";

if (!isset($_SESSION["UserID"]))
{
	echo "failure";
    header("Location: LogInAPP.php");
    die();
}

if( isset($_POST["SleepStart"]) && isset($_POST["SleepEnd"])  && isset($_POST["Rating"])) {
    $db->InsertSleepDatum($_SESSION["UserID"], $_POST["SleepStart"],$_POST["SleepEnd"], $_POST["Rating"]);
	echo "success";
}

else {
	echo "failure";
}

?>