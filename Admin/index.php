<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">

    <style type="text/css">
        body {
            background-color: #d84652;
        }

        #buttn {
            color: #fff;
            background-color: #ff3300;
        }
    </style>

</head>

<body>
<?php
include("../connection/dbconnect.php");
error_reporting(0);
session_start();
if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(!empty($_POST["submit"])) 
     {
	$loginquery ="SELECT * FROM users U INNER JOIN admins A ON U.U_ID = A.Admin_ID WHERE U.Username= '$username' AND U.Pass='$password'";
	$result=mysqli_query($db, $loginquery);
	$row=mysqli_fetch_array($result);
	
	                        if(is_array($row))
								{
                                    	$_SESSION["adm_id"] = $row['Admin_ID'];
                                        $success="Login Successful";
										 header("refresh:1;url=admin_profile.php");
	                            } 
							else
							    {
                                      	$message = "Invalid Username or Password!";
                                }
	 }	
}
?>

  
<div class="container">
  <div class="info">
    <h1>Administration </h1><span> login Account</span>
  </div>
</div>
<div class="form">
  <span style="color:red;"><?php echo $message; ?></span>
   <span style="color:green;"><?php echo $success; ?></span>
  <form class="login-form" action="index.php" method="post">
    <input type="text" placeholder="username" name="username"/>
    <input type="password" placeholder="password" name="password"/>
    <input type="submit"  name="submit" value="login" />
    <p class="message">Not registered? <a href="#">Create an account</a></p>
  </form>
  
</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='js/index.js'></script>
  

    



</body>

</html>