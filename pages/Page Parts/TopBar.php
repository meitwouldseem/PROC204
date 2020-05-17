

<div class="container">
    <nav class="navbar navbar-light navbar-fixed-top" style="background-color: #7289DA;">
        <form class="form-inline" action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
            <?php if(isset($_SESSION["UserID"])):?><label>Logged in as <?php echo $_SESSION["FirstName"],' ',$_SESSION["LastName"]?></label><?php endif; ?>
            <a href="inputData.php" class="btn btn-outline-white" role="button">Enter Data</a>
            <a href="graph.php" class="btn btn-outline-white" role="button">View Graphs</a>
            <a href="calenderView.php" class="btn btn-outline-white" role="button">View Calender</a>
            <a href="settings.php" class="btn btn-outline-white" role="button">Settings</a>
            <?php if(isset($_SESSION["UserID"])): ?> <input class="btn btn-outline-red" type="submit" name="logout" value="Log out">
            <?php else: ?> <a href="Login.php" class="btn btn-outline-green" role="button">Log in</a> <?php endif; ?>
        </form>
    </nav>
</div>