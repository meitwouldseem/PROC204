<?php

include_once "headerAPP.php";



if( isset($_POST["SleepStart"]) && isset($_POST["SleepEnd"]) && isset($_POST["UserID"]) && isset($_POST["Rating"])) {
    $db->InsertSleepDatum($_POST["UserID"], $_POST["SleepStart"],$_POST["SleepEnd"], $_POST["Rating"]);
	echo $_POST["SleepStart"];
}

else {
	echo "failure";
}

?>