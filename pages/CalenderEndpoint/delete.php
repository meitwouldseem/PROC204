<?php
include_once "../../classes/DBContext.php";
if(isset($_POST["id"]))
{
    $ID = substr($_POST["id"], 1);
    $db = new DBContext();
    if ($_POST["id"][0] == "S")
    {
        $db->DeleteSleep($ID);
        http_response_code(200);
    }
    elseif ($_POST["id"][0] == "E")
    {
        $db->DeleteEvent($ID);
        http_response_code(200);
    }
}
else
{
    echo "No parameters";
}
?>