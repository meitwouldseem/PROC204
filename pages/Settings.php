<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PROC204/classes/DBContext.php';
include_once "header.php";

if (!isset($_SESSION["UserID"]))
{
    header("Location: LogIn.php");
    die();
}

if( isset($_POST["colour"]) and isset($_SESSION["UserID"])) {
    $db->SetThemeSetting($_SESSION["UserID"], $_POST["colour"]);
}

if( isset($_POST["delete"])) {
    echo(1);
    if(isset($_SESSION["UserID"])){

        $db->DeleteUser($_SESSION["UserID"]);
        header("Location: LogIn.php");
    }
    else{
        echo("go to log in page");
    }
}

function checkColour($value){
    if (isset($_POST["colour"])){
        if ($value == 0){
            echo("checked=true");
        }
    }
    elseif ($_POST["colour"] == $value) {
        echo("checked=true");
    }
}
?>

<?php if(isset($_SESSION["UserID"]) and $db->GetThemeSetting($_SESSION["UserID"]) == 1): ?>
    <style>
        .input {
            background-color: #ffffbc;
            color: #ffa200;
            border-color: #bf6700;
        }

        .body{
            padding-top: 65px;
            background-color: #ffffbc
        }
        .title{
            color: #ffa200
        }
        }
    </style>
<?php else: ?>
    <style>
        .input {
            background-color: #2c2f33;
            color: #FFFFFF;
            border-color: #2c2f33;
        }

        .body{
            padding-top: 65px;
            background-color: #23272a
        }
        .title{
            color: #FFFFFF
        }
        }
    </style>
<?php endif; ?>



<body class="body">
<div class="container">
    <?php include "Page Parts/TopBar.php"; ?>
</div>

<div class="container">
    <main role="main" class="pb-3">
    </main>
</div>





<div class="container">
    <div class="row">
        <div class="col-5"></div>
        <div class="col-1">
            <h1 class="title">Settings</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-3"></div>
            <div class="col-6 text-center">
                <h3 class="text-centre title">Delete profile</h3>
                <form method="post" action="Settings.php">
                    <input type="submit"
                           name="delete" class="input"
                           value="Delete profile and ALL data?">
                </form>

            </div>
        </div>
    </div>
</div>

</body>

