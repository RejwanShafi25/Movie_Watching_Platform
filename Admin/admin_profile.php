<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/dbconnect.php");  // Include connection file
error_reporting(0);  // Using to hide undefined index errors
session_start(); // Start temp session until logout/browser closed
if (!isset($_SESSION["adm_id"])) {

    // Redirect to the login page
    header("Location: index.php"); // 
}

?>

<head>
    <title>Admin Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            background-color: #e9ecef;
            font-size: large;


        }

        .navbar {
            background-color: #22404A;

        }

        .navbar,
        .nav-link,
        .navbar-brand {
            color: white;
        }

        .navbar a:hover,
        .dropdown:hover .dropbtn {
            background-color: red;
        }


        .c1 {
            color: white;
        }

        .container {
            margin-left: 5%;
            margin-right: 0%;
        }

        .rounded-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;

            /* The Modal (background) */
            .modal {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);

                width: 400px;
                background: rgba(0, 0, 255, 0.45);
                padding: 20px;
            }

            .modal-content {
                opacity: 1;
            }

            /* Close Button */
            .close {
                float: right;
                cursor: pointer;
            }

            table {
                border-spacing: 0;
                border-collapse: collapse;
            }

            table,
            th,
            td {
                border: 1px solid black;
            }

            th,
            td {
                padding: 8px 16px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm ">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_profile.php"><img class="img-rounded" src="images/Untitled-1.png" height=70></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="me-auto"></div>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_profile.php"><b><i>Home</i></b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer_details.php">Customer Details</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Movies</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="allmovies.php">All movies</a></li>
                            <li><a class="dropdown-item" href="addmovie.php">Add movie</a></li>
                            <li><a class="dropdown-item" href="movie_request_check.php">Movie Request</a></li>
                            <!--<li><a class="dropdown-item" href="#">Movie Update</a></li> -->
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Payment</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="payment_request.php">Approval Request</a></li>
                            <li><a class="dropdown-item" href="payment_history.php">Payment History</a></li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav><br /><br />
    <?php
    $admin_id = $_SESSION["adm_id"];
    $sql = "SELECT * FROM users u INNER JOIN admins a on u.U_ID=a.Admin_ID WHERE u.U_ID=$admin_id;";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="conatiner text-center" style="text-align: left;">

        <h2>Welcome to Admin's Home Page </h2>

        <hr style="height: 50px; color: red; margin: 15px 0;">
        <section style="text-align: left;margin-left:5%;">
            <b><i>Admin ID: <?php echo $row["Admin_ID"] ?> </i></b><br /><br />
            <b><i>Admin Username: <?php echo $row["Username"] ?> </i></b><br /><br />
            <b><i>Admin Name: <?php echo $row["Admin_Name"] ?> </i></b><br /><br />
            <b><i>Email: <?php echo $row["Email"] ?> </i></b><br /><br />
        </section>
        <hr style="height: 50px; color: red; margin: 15px 0;">
        <div style="display: flex;">

            <div style="width: 33%;"> <button style="padding: 10px 20px; border-radius: 20px; background-color: blue; color: white; border: none;"><a class="nav-link" href="customer_details.php"><b><i>Customer Details</i></b></a></button> </div>
            <div style="width: 33%;"> <button style="padding: 10px 20px; border-radius: 20px; background-color: blue; color: white; border: none;"><a class="nav-link" href="allmovies.php"><b><i>All Movies</i></b></a></button> </div>
            <div style="width: 33%;"> <button style="padding: 10px 20px; border-radius: 20px; background-color: blue; color: white; border: none;"><a class="nav-link" href="addmovie.php"><b><i>Add Movies</i></b></a></button> </div>
        </div><br /><br />
        <div style="display: flex;">
            <div style="width: 33%;"> <button style="padding: 10px 20px; border-radius: 20px; background-color: blue; color: white; border: none;"><a class="nav-link" href="movie_request_check.php"><b><i>Movie Requests</i></b></a></button> </div>
            <div style="width: 33%;"> <button style="padding: 10px 20px; border-radius: 20px; background-color: blue; color: white; border: none;"><a class="nav-link" href="payment_request.php"><b><i>Payment Approval</i></b></a></button> </div>
            <div style="width: 33%;"> <button style="padding: 10px 20px; border-radius: 20px; background-color: blue; color: white; border: none;"><a class="nav-link" href="payment_history.php"><b><i>Payment History</i></b></a></button> </div>
        </div>
    </div>

</body>

</html>