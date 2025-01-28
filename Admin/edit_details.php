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
$id = $_GET['id'];
$sql = "SELECT * FROM old_movies WHERE Movie_index=$id";
$result = mysqli_query($db, $sql);

$isOld = mysqli_num_rows($result) > 0;
if ($isOld) {
    $sql = "SELECT m.Title, m.Movie_index,m.Trailer_link, o.Stream_Link FROM movies m  
    INNER JOIN old_movies o ON m.Movie_index = o.Movie_index
    WHERE m.Movie_index=$id";
    $result = mysqli_query($db, $sql);
    $movie = mysqli_fetch_assoc($result);
} else {

    $sql = "SELECT m.*, n.Movie_index FROM movies m INNER JOIN new_movies n ON m.Movie_index = n.Movie_index AND m.Movie_index=$id;";
    $result = mysqli_query($db, $sql);
    $movie = mysqli_fetch_assoc($result);
}

?>

<head>
    <title>Movie Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            background-color: #e9ecef;

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
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12" style="background-color:#E4DCCF; opacity:1; color: black; font-family: Arial, Helvetica, sans-serif; font-size: medium;">
                <br /><br />
                <div class="row">
                    <div class="form-group col-sm-8" style="font-size: 21px;">
                        Movie Info Update Form
                    </div>
                </div><br /><br />
                <form action="" method="POST">
                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label for="exampleInputEmail1" style="font-size: 21px;">Title</label>
                            <input class="form-control" type="text" name="title" value="<?php echo $movie['Title']; ?>" disabled>

                        </div>
                    </div><br /><br />
                    <?php if ($isOld) {
                        echo '<div class="row">';
                        echo '<div class="form-group col-sm-8">';
                        echo '<label for="exampleInputEmail1" style="font-size: 21px;">Stream Link</label>';
                        echo '<input class="form-control" type="text" name="stream">';
                        echo '</div>';
                        echo '</div>';
                        echo "<br/><br/>";
                        echo '<div class="row">';
                        echo '<div class="form-group col-sm-8">';
                        echo '<label for="exampleInputEmail1" style="font-size: 21px;">Trailer Link</label>';
                        echo '<input class="form-control" type="text" name="Trailer">';
                        echo '</div>';
                        echo '</div>';
                        echo "<br/><br/>";
                    } else {
                        echo '<div class="row">';
                        echo '<div class="form-group col-sm-8">';
                        echo '<label for="exampleInputEmail1" style="font-size: 21px;">Trailer link</label>';
                        echo '<input class="form-control" type="text" name="Trailer">';
                        echo '</div>';
                        echo '</div>';
                        echo "<br/><br/>";
                    } ?>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <p> <input type="submit" value="Submit" name="submit"> </p>
                        </div>
                    </div><br /><br />
                </form>

            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['submit']) && $isOld) {
        $stream = $_POST['stream'];
        $trailer = $_POST['Trailer'];
        if (!empty($stream) && !empty($trailer)) {
            $sql = "UPDATE old_movies SET Stream_Link='$stream' WHERE Movie_index=$id;";
            mysqli_query($db, $sql);
            $sql = "UPDATE movies SET Trailer_link='$trailer' WHERE Movie_index=$id;";
            mysqli_query($db, $sql);
        } else if (!empty($stream)) {
            $sql = "UPDATE old_movies SET Stream_Link='$stream' WHERE Movie_index=$id;";
            mysqli_query($db, $sql);
        } else if (!empty($trailer)) {
            $sql = "UPDATE movies SET Trailer_link='$trailer' WHERE Movie_index=$id;";
            mysqli_query($db, $sql);
        } else {
            $message = "No data to update";
            header("Location: edit_details.php");
        }
    } else if (isset($_POST['submit'])) {
        $trailer = $_POST['Trailer'];
        if (!empty($trailer)) {
            $sql = "UPDATE movies SET Trailer_link='$trailer' WHERE Movie_index=$id;";
            mysqli_query($db, $sql);
        } else {
            $message = "No data to update";
            header("Location: edit_details.php");
        }
    }

    ?>

</body>

</html>