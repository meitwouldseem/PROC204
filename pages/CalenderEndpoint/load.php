<?php
include_once "../../classes/DBContext.php";
if(isset($_GET["start"], $_GET["end"]))
{
    $db = new DBContext();
    echo json_encode($db->GetUsersCalenderData(0, $_GET["start"], $_GET["end"]));
}
else
{
    echo "No parameters";
}
?>