<?php

include_once "header.php";

if (isset($_POST["Login"]))
{
    if (strlen($_POST["password"]) > 5 && strlen($_POST["email"]) > 0)
    {
        $data = $db->GetLoginData($_POST["email"])[0];

        if (password_verify($_POST["password"], $data[0]))
        {
            $_SESSION["UserID"] = $data[1];
            header("Location: InputData.php");
        }
        else
        {
            echo "<script> window.onload = function () {window.alert(\"Your email and/or password was incorrect.\")} </script>";
        }

    }else{
        echo "<script> window.onload = function () {window.alert(\"Your details where invalid.\")} </script>";
    }
}
elseif (isset($_POST["SignUp"])){
    header("Location: SignUp.php");
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
<?php include "Page Parts/TopBar.php" ?>
<div class="container">
    <main role="main" class="pb-3">
    </main>
</div>
<div class="container">
    <form  method="post" action="LogIn.php">
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
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <input class="btn btn-primary" name="Login" type="submit" value="Log in">
            </div>
            <div class="col-4"></div>
        </div>
        <h1></h1>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <input class="btn btn-primary" name="SignUp" type="submit" value="Dont have a login? Sign up">
            </div>
            <div class="col-4"></div>
        </div>
    </form>
</div>

</body>

