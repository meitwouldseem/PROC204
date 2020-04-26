<?php

include_once "header.php";

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
    <form  method="post" action="InputData.php">
        <div class="row">
            <div class="col-5"></div>
            <div class="input-group input-group-sm mb-3 col-2">
                <div class="input-group-prepend">
                    <span class="input-group-text input" id="basic-addon1">User ID</span>
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
                <input type="password" min="1" max="5" class="input" name="Rating" style="align-self: center">
            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <input class="btn btn-primary" name="Submit" type="submit" value="Submit">
            </div>
            <div class="col-4"></div>
        </div>
    </form>
</div>

</body>

