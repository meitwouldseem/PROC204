<?php

include_once "headerAPP.php";


if( isset($_POST["delete"])) {
    if(isset($_POST["UserID"])){

        $db->DeleteUser($_POST["UserID"]);
    }
}
else {
	echo "failure";
}

?>