<!DOCTYPE html>
<html lang="en">
<?php
include("connection/dbconnect.php");  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed


?>
<?php
if (isset($_POST['submit'])) {

    $userId = $_SESSION['user_id'];

    $movieName = $_POST['movie_name'];
    //Checking if the movie already exist in the database
    $sql = "SELECT * FROM movies WHERE Title='$movieName'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Movie found - show message
        $message="This movie already exists in the website database!";
        
    } else {
        $sql = "UPDATE customer SET Requested_Movie='$movieName' WHERE Customer_ID=$userId";
        if (mysqli_query($db, $sql)) {
            $message="You have requested the movie $movieName successfully!";
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Your Profile</title>
    <style>
        body {
            background-color: #00111c;

        }

        input {
            background-color: white;
            color: black;
            border: 0;
        }

        .navbar {
            background-color: #22404A;
        }

        .navbar,
        .nav-link,
        .navbar-brand {
            color: white;
        }

        .section1 {
            color: aliceblue;
        }

        .c1 {
            color: white;
        }

        .rounded-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .form-group-2 {
            margin-left: 1.75in;
            text-align: left;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">

        <div class="container-fluid">

            <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="img/project logo.png" widtgh='250' height='40' alt=""> </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Empty div to push menu items to right -->
                <div class="me-auto"></div>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php" style="color:white;font-style:italic;">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="available_movies.php" style="color:white;font-style:italic;">Movies</a>
                    </li>

                    <!-- Rest of items 
                    <li class="nav-item">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        
                    </li> -->
                    <?php
                    if (empty($_SESSION["user_id"])) {
                        echo '<li class="nav-item"><a href="login.php" class="nav-link active"style="color:white;font-style:italic;">Login</a> </li>
                      <li class="nav-item"><a href="registration.php" class="nav-link active"style="color:white;font-style:italic;">Signup</a> </li>';
                    } else {
                        echo '<li class="nav-item"><a href="Movie_request.php" class="nav-link active"style="color:white;font-style:italic;">Request a Movie</a> </li>';
                        //echo '<li class="nav-item"><a href="Ticket_Purchase.php" class="nav-link active"style="color:white;font-style:italic;">Buy Ticket</a> </li>';
                        echo '<li class="nav-item"><a href="Customer_profile.php" class="nav-link active"style="color:white;font-style:italic;">Profile</a> </li>';
                        echo '<li class="nav-item"><a href="logout.php" class="nav-link active"style="color:white;font-style:italic;">Logout</a> </li>';
                    }
                    ?>
                </ul>


            </div>

        </div>

    </nav>

    <br /><br /><br />
    <?php
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM customer where Customer_ID=$user_id";

    $result = mysqli_query($db, $sql);

    $user_data = mysqli_fetch_assoc($result);
    $requestedMovie = $user_data['Requested_Movie'];
    ?>

    <div class="container text-center">
        <div class="row">
            <div class="col-md-12" style="background-color:#E4DCCF; opacity:1; color: black; font-family: Arial, Helvetica, sans-serif; font-size: medium;">
                <br /><br />
                <section>
                    <img src="img/blank-profile-picture.png" class="rounded-circle"><br />
                    Welcome <input value="<?php echo $user_data['Customer_Name'] ?>" disabled>;
                </section>
                <br />
                <?php
                if ($requestedMovie == NULL) { ?>

                    <form action="" method="post">

                        <div class="row">
                            <div class="form-group col-sm-8">

                                <h5>Request Movie: <input type="text" name="movie_name" placeholder="Enter the movie name"> </h5>
                            </div>
                        </div><br /><br />
                        <div class="row">
                            <p><input type="submit" value="Register" name="submit"> </p>

                        </div>
                        <div class="row text-center" style="color:red;">
                            <?php echo $message; ?>
                        </div>


                    </form>
                <?php } else { ?>
                    <div class="row text-center" style="color:red;">
                        Your requested movie <?php echo $requestedMovie; ?> is awaiting moderation. You can request another movie after the admin reviews your current request.
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

</body>

</html>