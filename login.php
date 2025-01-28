<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/login.css">

    <style type="text/css">
        body {
            background-color: #E9ECEF;
        }

        #buttn {
            color: #fff;
            background-color: #ff3300;
        }
    </style>

</head>

<body>
    <?php
    include("connection/dbconnect.php"); // connecting to database
    error_reporting(0);
    session_start();
    if (isset($_POST['submit']))   // if button is submit
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (!empty($_POST["submit"])){
            $query="SELECT * FROM users U INNER JOIN customer C ON U.U_ID = C.Customer_ID WHERE U.Username= '$username' AND U.Pass='$password'";
            $result=mysqli_query($db,$query);
            $row=mysqli_fetch_array($result);
            if(is_array($row)) //if matcing record in array and if everything is right
            {
                $_SESSION["user_id"]=$row["U_ID"]; //storing user_id into temp session
                header("refresh:1;url=index.php");//redircts to index.php
            }
            else{
                $message="Invalid Username or Password!";
                header("location:login.php");
            }
        }
    }
    ?>
    <div class="pen-title">
        <h2>Login</h2>
    </div>
    <div class="module form-module">
        <div class="toggle">

        </div>
        <div class="form">
            <h2>Login to your account</h2>
            <span style="color:red;"><?php echo $message; ?></span>
            <span style="color:green;"><?php echo $success; ?></span>
            <form action="" method="post">
                Username: <input type="text" name="username" />
                Password: <input type="password" name="password" />
                <input type="submit" id="buttn" name="submit" value="login" />
            </form>
        </div>
        <div class=cta>Not Registers? <a href="registration.php" style="color:red;">Create an account</a></div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>

</html>