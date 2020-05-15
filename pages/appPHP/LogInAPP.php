
<?php
include_once "headerAPP.php";




if(isset($_POST["email"])){
    $mysql_email = $_POST["email"];
	$data = $db->GetLoginData($_POST["email"])[0];
}

if(isset($_POST['password'])){
    $mysql_password = $_POST['password'];
}
if (isset($_POST["password"]) && isset($_POST["email"]))
{
if (strlen($_POST["password"]) > 5 && strlen($_POST["email"]) > 0)
{
if (password_verify($_POST["password"], $data[0]))
       {
           $_SESSION["UserID"] = $data[1];
		   echo "success";
	   }
	   else
        {
            echo "Your email and/or password was incorrect";
        }
		
		
		
}else
		{
			echo "Your details where invalid.";
		}
}

else
		{
			echo "Your details where invalid.";
		}
?>