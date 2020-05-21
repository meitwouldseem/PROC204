<?php

include_once "headerAPP.php";

if( isset($_POST["sleepStats"])) {
	if(isset($_POST["UserID"])){
	$graphdata = $db->GetSleepRange(date("Y-m-d H:m:s",strtotime("-7 days")), date("Y-m-d H:m:s",strtotime("-0 days")), $_POST["UserID"]);
	if ($graphdata)
	{
		echo (json_encode($graphdata));
	}
	}
}

?>