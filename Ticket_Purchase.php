<!DOCTYPE html>
<html lang="en">
<?php
include("connection/dbconnect.php");  // Include connection file
error_reporting(0);  // Using to hide undefined index errors
session_start(); // Start temp session until logout/browser closed
if (!isset($_SESSION["user_id"])) {

    // User not logged in
    header("Location: login.php");
    exit('Success');
}
$uid = $_SESSION["user_id"];
$movieid = $_GET['id'];
$sql = "SELECT * FROM new_movies n INNER JOIN movies m on n.Movie_Index=m.Movie_index WHERE n.Movie_index=$movieid";
$result = mysqli_query($db, $sql);
$movie = mysqli_fetch_assoc($result);
$mov_hall = $movie["hall_number"];


$sql = "SELECT h.Hall_Number, h.Type, h.seats, h.price, hd.Remaining_Seat, hd.Times, n.Movie_index, m.Title FROM hall h LEFT JOIN hall_details hd ON h.Hall_Number = hd.Hall_Number INNER JOIN new_movies n ON n.Hall_Number = h.Hall_Number INNER JOIN movies m ON n.Movie_index = m.Movie_index WHERE h.Hall_Number = (SELECT n.hall_number FROM new_movies n WHERE n.Movie_index = '$movieid') and h.Hall_Number=$mov_hall; ";
$hall_timings_result = mysqli_query($db, $sql);
$hall_timings = array();

while ($row = mysqli_fetch_assoc($hall_timings_result)) {

    $hall_timings[$row['Hall_Number']][] = $row['Times'];
    $cinetype = $row["Type"];
    $price = $row["price"];
    $hall_id = $row["Hall_Number"];
    $title = $row["Title"];
    $available_seats = $row["Remaining_Seat"];
}


?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buy Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #00111c;
        }

        .navbar {
            background-color: #22404A;
        }

        .navbar,
        .nav-link,
        .navbar-brand {
            color: white;
        }

        .filter-genres {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            flex-wrap: wrap;
        }

        .filter-genres a {
            display: inline-block;
            margin-right: 20px;
            color: #007bff;
            text-decoration: none;
            flex: 1;
            font-family: Arial, Helvetica, sans-serif;
            font-size: medium;
            color: wheat;
        }

        .filter-genres a:hover {
            text-decoration: underline;
        }

        .section1 {
            color: aliceblue;
        }

        .card {
            width: 12rem;
            height: 18rem;
            /* fixes width */
        }

        .card-img-top {
            height: 18rem;
            width: 12rem;
            object-fit: fill;
        }

        .card-body {
            background-color: #00111c;
            opacity: 1;
        }

        .card-title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            font-style: oblique;
            color: beige;
            opacity: 1;
            text-align: left;
            padding-left: 2%;
        }

        .row-cols-3 .col {
            flex: 0 0 50%;
            /* makes columns 50% width each */
            max-width: 50%;
            /* fallback for older browsers */
        }

        section {
            position: relative;
            image-resolution: 100%;
        }

        section img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            opacity: 0.45;
        }

        .line::after {
            content: "";
            display: block;
            width: 100%;
            height: 2px;
            background: rgba(255, 255, 255, 0.35);
        }

        .modal-backdrop {
            backdrop-filter: blur(5px);
            /* Adjust the blur value as needed */
            background-color: rgba(0, 0, 0, 0.5);
            /* Adjust the opacity value as needed */
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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

                    <!-- Rest of items -->

                    <?php
                    if (empty($_SESSION["user_id"])) {
                        echo '<li class="nav-item"><a href="login.php" class="nav-link active"style="color:white;font-style:italic;">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active"style="color:white;font-style:italic;">Signup</a> </li>';
                    } else {
                        echo '<li class="nav-item"><a href="Movie_request.php" class="nav-link active"style="color:white;font-style:italic;">Request a Movie</a> </li>';
                        echo '<li class="nav-item"><a href="Ticket_Purchase.php" class="nav-link active"style="color:white;font-style:italic;">Buy Ticket</a> </li>';
                        echo '<li class="nav-item"><a href="Customer_profile.php" class="nav-link active"style="color:white;font-style:italic;">Profile</a> </li>';
                        echo '<li class="nav-item"><a href="logout.php" class="nav-link active"style="color:white;font-style:italic;">Logout</a> </li>';
                    }
                    ?>
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
                        <?php echo $movie['Title']; ?> Ticket Purchase
                    </div>
                </div><br /><br />

                <!-- Button to trigger the modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ticketModal">
                    Buy Ticket
                </button>

                <!-- Modal -->
                <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ticketModalLabel">Ticket Purchase for <?php echo $movie['Title']; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="payment_confirmation.php" method="POST">
                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <input class="form-control" type="text" name="uid" value="<?php echo $uid; ?>" hidden>
                                            <input class="form-control" type="text" name="mid" value="<?php echo $movieid; ?>" hidden>
                                            <input class="form-control" type="text" name="Availableseats" value="<?php echo $available_seats; ?>" hidden>
                                        </div>
                                    </div><br /><br />
                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="exampleInputEmail1" style="font-size: 21px;">Title</label>

                                            <input class="form-control" type="text" name="titlex" value="<?php echo $movie['Title']; ?>" disabled>
                                            <input class="form-control" type="text" name="titlex" value="<?php echo $movie['Title']; ?>" hidden>
                                        </div>
                                    </div><br /><br />


                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="exampleInputEmail1" style="font-size: 21px;">Cinema Type</label>
                                            <input class="form-control" type="text" name="Cine_type" value="<?php echo $cinetype; ?>" disabled>
                                            <input class="form-control" type="text" name="Cine_type" value="<?php echo $cinetype; ?>" hidden>
                                        </div>
                                    </div><br /><br />

                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="exampleInputEmail1" style="font-size: 21px;">Hall Number</label>
                                            <input class="form-control" type="text" name="hall_no" value="<?php echo $hall_id; ?>" disabled>
                                            <input type="hidden" name="hall_no" value="<?php echo $hall_id; ?>">
                                        </div>
                                    </div><br /><br />

                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="exampleInputEmail1" style="font-size: 21px;">Hall Timing</label>
                                            <select name="timing">
                                                <?php foreach ($hall_timings as $hall_number => $timings) {
                                                    foreach ($timings as $time) {
                                                        echo "<option value=\"$time\">$time</option>";
                                                    }
                                                } ?>
                                            </select>
                                        </div>
                                    </div><br /><br />

                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="number_of_seats" style="font-size: 21px;">Number of Seats</label>
                                            <input class="form-control" type="number" name="number_of_seats" min="1" required>
                                        </div>
                                    </div><br /><br />

                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="date" style="font-size: 21px;">Watch Date</label>
                                            <input type="date" class="form-control" name="date" required><br />
                                        </div>
                                    </div><br /><br />

                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <label for="date" style="font-size: 21px;">Price per Seat</label>
                                            <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" disabled><br />
                                            <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" hidden>
                                        </div>
                                    </div><br /><br />

                                    <div class="row">
                                        <div class="form-group col-sm-8">
                                            <p> <input type="submit" value="Proceed to Payment" name="submit" class="btn btn-primary"> </p>
                                        </div>
                                    </div><br /><br />
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</body>

</html>