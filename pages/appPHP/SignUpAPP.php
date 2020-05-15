<?php

include_once "headerAPP.php";


if (isset($_POST["CreateAccount"]))
{
    if (strlen($_POST["password"]) > 5 && strlen($_POST["firstname"]) > 0 && strlen($_POST["surname"]) > 0 && strlen($_POST["email"]) > 0)
    {
        $db->InsertUser($_POST["email"], $_POST["firstname"], $_POST["surname"], password_hash($_POST["password"], PASSWORD_DEFAULT));
		echo "success";
    }else{
        echo "Your details where invalid";
    }
}

?>
