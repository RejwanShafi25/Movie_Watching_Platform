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
$admin_id = $_SESSION["adm_id"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_movie'])) {
    $userId = $_POST['userId'];

    // Update the requested movie to NULL for the selected customer
    $updateQuery = "UPDATE customer SET Requested_Movie = NULL WHERE Customer_ID = $userId";
    $updateResult = mysqli_query($db, $updateQuery);
    
    $updateQuery = "UPDATE customer SET Admin_ID=$admin_id WHERE Customer_ID = $userId";
    $updateResult = mysqli_query($db, $updateQuery);

    if ($updateResult) {
        // Successfully updated requested movie to NULL
        // Redirect or refresh the page as needed
        header("Location: addmovie.php");
        exit(); // Stop further execution
    } else {
        // Handle error if the update query fails
        echo "Error updating requested movie: " . mysqli_error($db);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_movie'])) {
    $userId = $_POST['userId'];

    // Update the requested movie to NULL for the selected customer
    $updateQuery = "UPDATE customer SET Requested_Movie = NULL WHERE Customer_ID = $userId";
    $updateResult = mysqli_query($db, $updateQuery);

    if ($updateResult) {
        // Successfully updated requested movie to NULL
        // Redirect or refresh the page as needed
        header("Location: movie_request_check.php");
        exit(); // Stop further execution
    } else {
        // Handle error if the update query fails
        echo "Error updating requested movie: " . mysqli_error($db);
    }
}

?>

<head>
    <title>Add Movie</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #e9ecef;

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

        .navbar a:hover,
        .dropdown:hover .dropbtn {
            background-color: red;
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

        table {
            border-collapse: collapse;
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px 16px;
            border: 1px solid black;
        }

        input[name="add_movie"] {
            background-color: green;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
        }

        /* Red */
        input[name="delete_movie"] {
            background-color: red;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
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
                        <a class="nav-link" href="customer_details.php">Customer_Details</a>
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
    <div class="container" style="background-color:#a8dadc;">
        <center>
            <h2><i>Requested Movies</i></h2><br />
            <table>
                <thead>
                    <tr>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Requested Movie</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Retriving requested movie from the database
                    $query = "SELECT * from users U INNER JOIN customer C on U.U_ID=C.Customer_ID WHERE C.Requested_Movie  IS NOT NULL";
                    $result = mysqli_query($db, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['U_ID'] . "</td>";
                            echo "<td>" . $row['Username'] . "</td>";
                            echo "<td>" . $row['Customer_Name'] . "</td>";
                            echo "<td>" . $row['Requested_Movie'] . "</td>";
                            echo "<td>
                                <form action='' method='post'>
                                    <input type='hidden' name='movie' value='" . $row['U_ID'] . "'>
                                    <input type='submit' name='add_movie' value='Add Movie'>
                                
                                    <input type='hidden' name='userId' value='" . $row['U_ID'] . "'>
                                    <input type='submit' name='delete_movie' value='Delete'>
                                </form>
                            </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </center>

    </div>

</body>

</html>