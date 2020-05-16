<?php

include_once "header.php";
if (isset($_SESSION["UserID"]))
{
    header("Location: InputData.php");
    die();
}

if (isset($_POST["CreateAccount"]))
{
    if (strlen($_POST["password"]) > 5 && strlen($_POST["firstname"]) > 0 && strlen($_POST["surname"]) > 0 && strlen($_POST["email"]) > 0)
    {
        $db->InsertUser($_POST["email"], $_POST["firstname"], $_POST["surname"], password_hash($_POST["password"], PASSWORD_DEFAULT));
        $data = $db->GetLoginData($_POST["email"])[0];
        $db->InsertSettings($data[1]);
        $_SESSION["UserID"] = $data[1];
        header("Location: InputData.php");
    }else{
        echo "<script> window.onload = function () {window.alert(\"Your details where invalid.\")} </script>";
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
    <?php include "Page Parts/TopBar.php" ?>
    <h1></h1>
    <h2></h2>
</div>
<div class="container">
    <main role="main" class="pb-3">
    </main>
</div>
<div class="container">
    <form  method="post" action="SignUp.php">
        <div class="row">
            <div class="col-5"></div>
            <div class="input-group input-group-sm mb-3 col-2">
                <div class="input-group-prepend">
                    <span class="input-group-text input" id="basic-addon1">Email address</span>
                </div>
                <input type="text" class="input" name="email" style="align-self: center">
            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-5"></div>
            <div class="input-group input-group-sm mb-3 col-2">
                <div class="input-group-prepend">
                    <span class="input-group-text input" id="basic-addon1">Password</span>
                </div>
                <input type="password" class="input" name="password" style="align-self: center">
            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-5"></div>
            <div class="input-group input-group-sm mb-3 col-2">
                <div class="input-group-prepend">
                    <span class="input-group-text input" id="basic-addon1">First Name</span>
                </div>
                <input type="text" class="input" name="firstname" style="align-self: center">
            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-5"></div>
            <div class="input-group input-group-sm mb-3 col-2">
                <div class="input-group-prepend">
                    <span class="input-group-text input" id="basic-addon1">Surname</span>
                </div>
                <input type="text" class="input" name="surname" style="align-self: center">
            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <input class="btn btn-primary" name="CreateAccount" type="submit" value="Create Account">
            </div>
            <div class="col-4"></div>
        </div>
    </form>
</div>

</body>

