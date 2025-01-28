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
?>


<head>
    <title>PAll Payments</title>
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

    <center>
        <section style="background-color:#a8dadc;">
            <h2><i>All Payments</i></h2><br />
            <table>
                <thead>
                    <tr>
                        <th>Payment_ID</th>
                        
                        <th>Amount</th>
                        <th>Customer_ID</th>
                        <th>Movie Name</th>
                        <th>Purchase Date</th>
                        <th>Premier Date </th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT p.*,t.Ticket_ID,t.Movie_Index,m.Title, t.Purchased_Date,T.Ticket_day FROM ticket t INNER JOIN payment p ON t.Customer_ID = p.Customer 
                    INNER JOIN new_movies n ON t.Movie_Index = n.Movie_Index INNER JOIN Movies m ON n.Movie_Index = m.Movie_Index ORDER BY Ticket_day asc; ";
                    $result = mysqli_query($db, $sql);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";

                            echo "<td>" . $row['Payment_ID'] . "</td>";
                            echo "<td>" . $row['Customer'] . "</td>";
                            echo "<td>" . $row['Amount'] . "</td>";
                            echo "<td>" . $row['Ticket_ID'] . 'mins' . "</td>";
                            echo "<td>" . $row['Title'] . "</td>";
                            echo "<td>" . $row['Purchased_Date'] . "</td>";
                            echo "<td>" . $row['Ticket_day'] . "</td>";


                            echo "</tr>";
                        }
                    }
                    ?>



                </tbody>
            </table>

        </section>
    </center>


</body>

</html>