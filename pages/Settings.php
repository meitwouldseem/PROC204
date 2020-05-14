<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/PROC204/classes/DBContext.php';
include_once "header.php";

if( isset($_POST["colour"]) and isset($_SESSION["UserID"])) {
    DBContext.SetThemeSetting($_SESSION["UserID"], $_POST["colour"]);
}

if( isset($_POST["delete"])) {
    if(isset($_SESSION["UserID"])){
        DBContext.DeleteUser($_SESSION["UserID"]);
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

<?php if(isset($_SESSION["UserID"]) and DBContext.GetThemeSetting($_SESSION["UserID"]) == 1): ?>
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
    <nav class="navbar navbar-light navbar-fixed-top" style="background-color: #7289DA;">
        <form class="form-inline">
            <a class="btn btn-outline-white" role="button">Look at Data</a>
            <a class="btn btn-outline-white" role="button">Enter Data</a>
            <a class="btn btn-outline-white" role="button">Settings</a>
        </form>
    </nav>
    <h1></h1>
    <h2></h2>
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
        <div class="col-2"></div>
            <div class="col-8 text-center">
                <h3 class="text-centre title">Colour Scheme</h3>
                <form  method="post" action="Settings.php">
                    <?php if (!isset($_POST["colour"]) or $_POST["colour"]=="0"):?>
                        <input type="radio" onchange='this.form.submit()' id="colour-default" name="colour" value ="0" checked="true" >
                        <label for="colour-default" style="color: #7289DA" >Default</label><br>
                        <input type="radio" onchange='this.form.submit()' id="colour-light"   name="colour" value ="1">
                        <label for="colour-light" style="color: #ffffff">Light</label><br>
                    <?php else:?>
                        <input type="radio" onchange='this.form.submit()' id="colour-default" name="colour" value ="0"  >
                        <label for="colour-default" style="color: #7289DA" >Default</label><br>
                        <input type="radio" onchange='this.form.submit()' id="colour-light"   name="colour" value ="1" checked="true" >
                        <label for="colour-light" style="color: #ffffff">Light</label><br>
                    <?php endif?>
                </form>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-3"></div>
            <div class="col-6 text-center">
                <h3 class="text-centre title">Delete profile</h3>
                <input type="button" id="delete"
                       name="delete" class="input"
                       value="Delete profile and ALL data?">
            </div>
        </div>
    </div>
</div>

</body>

