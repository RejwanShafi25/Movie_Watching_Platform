<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(0);
include("connection/dbconnect.php"); //connection
if (isset($_POST['submit'])) {
  if (
    empty($_POST['username']) ||
    empty($_POST['fname']) ||
    empty($_POST['email']) ||
    empty($_POST['phone']) ||
    empty($_POST['password']) ||
    empty($_POST['cpassword'])
  ) {
    $message = "All fields must be Required!";
  } else {
    //cheching if username and email already exists in database
    $check_username = mysqli_query($db, "SELECT Username FROM users where Username = '" . $_POST['username'] . "' ");
    $check_email = mysqli_query($db, "SELECT Email FROM users where Email = '" . $_POST['email'] . "' ");

    

    if ($_POST['password'] != $_POST['cpassword']) {  //matching passwords
      $message = "Password not match";
    } elseif (strlen($_POST['password']) < 6)  //checking if password length is less than 6 or not
    {
      $message = "Password Must be >=6";
    } elseif (strlen($_POST['phone']) < 10)  //checking if password length is less than 6 or not
    {
      $message = "invalid phone number!";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
    {
      $message = "Invalid email address please type a valid email!";
    } elseif (mysqli_num_rows($check_username) > 0)  //check username
    {
      $message = 'username Already exists!';
    } elseif (mysqli_num_rows($check_email) > 0) //check email
    {
      $message = 'Email Already exists!';
    } else {

      //inserting values into db
      $sql = "INSERT INTO users(Username, Email, Pass) 
        VALUES('" . $_POST['username'] . "', 
               '" . $_POST['email'] . "',
               '" . $_POST['password'] . "')";

      mysqli_query($db, $sql);
      //Retriving id of inserted user
      $user_id = mysqli_insert_id($db);
      $sql = "INSERT INTO customer(Customer_Name, Phone_Number, Customer_ID)  
           VALUES('" . $_POST['fname'] . "',
                  '" . $_POST['phone'] . "', 
                  $user_id)";

      mysqli_query($db, $sql);

      $success = "Account Created successfully! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
                           <script type='text/javascript'>
                           function countdown() {
                             var i = document.getElementById('counter');
                             if (parseInt(i.innerHTML)<=0) {
                               location.href = 'login.php';
                             }
                             i.innerHTML = parseInt(i.innerHTML)-1;
                           }
                           setInterval(function(){ countdown(); },1000);
                           </script>'";

      header("refresh:5;url=login.php"); // After succssful insertion redirects to login page
    }
  }
}


?>




<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="#">
  <title>Registration</title>
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animsition.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Blacksword&display=swap');

  body {
    background-color: #E9ECEF;
  }

  .blacksword-font {
    font-family: 'Blacksword', cursive;
    font-style: italic;
    font-size: 25px;
    color: #E4DCCF;
  }


  .navbar {
    background-color: #22404A;
    font-style: italic;
  }
</style>
</head>

<body>
  <header id="header" class="header-scroll top-header headroom">
    <nav class="navbar navbar-dark">
      <div class="container-fluid">
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
        <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="img/project logo.png" widtgh='250' height='40' alt=""> </a>
        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
          <ul class="nav navbar-nav">
            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
            <li class="nav-item"> <a class="nav-link active" href="available_movies.php">Movies <span class="sr-only"></span></a> </li>
            <!-- 
            <li class="nav-item">
              <form class="d-flex"><input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"><button class="btn btn-outline-success" type="submit">Search</button></form>
            </li>
            -->
            <?php
            if (empty($_SESSION["user_id"])) {
              echo '<li class="nav-item"><a href="login.php" class="nav-link active">login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">signup</a> </li>';
            } else {
              echo '<li class="nav-item"><a href="Ticket_Purchase.php" class="nav-link active">Buy Ticket</a> </li>';
              echo '<li class="nav-item"><a href="Customer_profile.php" class="nav-link active">Profile</a> </li>';
              echo '<li class="nav-item"><a href="logout.php" class="nav-link active">logout</a> </li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- Navbar ends-->
  <div class="page-wrapper">
    <div class="breadcrumb">
      <div class="container">
        <ul>
          <li>
            <a href="#" class="active">
              <span style="color:red;"><?php echo $message; ?> </span>
              <span style="color:green;"><?php echo $success; ?> </span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <section class="contact-page inner-page" style="color:#22404A;">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="widget">
              <div class="widget-body">

                <form action="" method="post">
                  <div class="row">
                    <div class="form-group col-sm-12">
                      <label for="exampleInputEmail1" style="font-size: 21px;">User-Name</label>
                      <input class="form-control" type="text" name="username" id="example-text-input" placeholder="UserName">
                    </div>

                    <div class="form-group col-sm-6">
                      <label for="exampleInputEmail1" style="font-size: 21px;">Full Name</label>
                      <input class="form-control" type="text" name="fname" id="example-text-input" placeholder="Full name">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="exampleInputEmail1" style="font-size: 21px;">Email Address</label>
                      <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> <small id="emailHelp" class="form-text text-muted" style="font-size: 16px;">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group col-sm-6">
                      <label for="exampleInputEmail1" style="font-size: 21px;">Phone Number</label>
                      <input class="form-control" type="text" name="phone" id="example-tel-input-3" placeholder="Phone"> <small class="form-text text-muted" style="font-size: 16px;">We"ll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="exampleInputPassword1" style="font-size: 21px;">Password</label>
                      <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="exampleInputPassword1" style="font-size: 21px;">Repeat password</label>
                      <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" placeholder="Password">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-4">
                      <p> <input type="submit" value="Register" name="submit"> </p>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <!-- Bootstrap core JavaScript
    ================================================== -->
  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/animsition.min.js"></script>
  <script src="js/bootstrap-slider.min.js"></script>
  <script src="js/jquery.isotope.min.js"></script>
  <script src="js/headroom.js"></script>
  <script src="js/foodpicky.min.js"></script>
</body>

</html>

</body>

</html>