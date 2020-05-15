<?php
date_default_timezone_set("Europe/London");

include_once "./classes/DBContext.php";

$db = new DBContext();

session_start();

if (isset($_POST["logout"]))
{
    session_destroy();
}
?>