
<?php
include_once "headerAPP.php";


if (isset($_SESSION["UserID"]))
{
    header("Location: InputDataAPP.php");
    die();
}

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
		   $_SESSION["FirstName"] = $data[2];
           $_SESSION["LastName"] = $data[3];
    
		   echo "success";
		   echo $data[1];
		   
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