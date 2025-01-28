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
    <title>All Movies</title>
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
    <div class="text-end" style="background-color:#a8dadc; opacity:0.75; color:1;">
        <section class="d-flex justify-content-end">
            <a class="nav-link me-3" href="?filter=all" style="color:black;"><b><i><u>All Movies</u></i></b></a>
            <a class="nav-link me-3" href="?filter=new" style="color:black;"><b><i><u>New Movies</u></i></b></a>
            <a class="nav-link" href="?filter=old" style="color:black;"><b><i><u>Old Movies</u></i></b></a>
        </section>
    </div>
    <center>
        <section style="background-color:#a8dadc;">
            <h2><i>Movies</i></h2><br />
            <table>
                <thead>
                    <tr>
                        <th>Index</th>
                        <th>Title</th>
                        <th>Trailer</th>
                        <th>Year</th>
                        <th>Runtime</th>
                        <th>Genres</th>
                        <th>Casts</th>
                        <th>Prequel</th>
                        <?php
                        $movieType = isset($_GET['filter']) ? $_GET['filter'] : "";
                        if ($movieType == "old") {
                            echo "<th>Stream Link</th>";
                        }
                        if (($movieType == "all") || ($movieType == "")) {
                            echo "<th>Action</th>";
                        } else {
                        }
                        ?>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($movieType == "new") {
                        $sql = "SELECT M.*, GROUP_CONCAT(DISTINCT G.Genre) AS MovieGenres, GROUP_CONCAT(DISTINCT C.Cast) AS MovieCasts  FROM movies M  INNER JOIN new_movies N on M.Movie_index=N.Movie_index LEFT JOIN movie_genre G 
                    ON M.Movie_index = G.Movie_index  LEFT JOIN movie_castings C ON M.Movie_index = C.Movie_index GROUP BY M.Movie_index";
                        $result = mysqli_query($db, $sql);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['Movie_index'] . "</td>";
                                echo "<td>" . $row['Title'] . "</td>";
                                echo "<td>" . $row['Trailer_link'] . "</td>";
                                echo "<td>" . $row['Release_Date'] . "</td>";
                                echo "<td>" . $row['Watch_Time'] . 'mins' . "</td>";
                                echo "<td>" . $row['MovieGenres'] . "</td>";
                                echo "<td>" . $row['MovieCasts'] . "</td>";

                                echo "<td>" . $row['Pre_sequel'] . "</td>";
                            }
                            echo "</tr>";
                        }
                    } ?>



                    <?php
                    if ($movieType == "old") {
                        $sql = "SELECT M.*, GROUP_CONCAT(DISTINCT G.Genre) AS MovieGenres, GROUP_CONCAT(DISTINCT C.Cast) AS MovieCasts,O.Stream_link  FROM movies M  INNER JOIN old_movies O on M.Movie_index=O.Movie_index LEFT JOIN movie_genre G 
                    ON M.Movie_index = G.Movie_index  LEFT JOIN movie_castings C ON M.Movie_index = C.Movie_index GROUP BY M.Movie_index";
                        $result = mysqli_query($db, $sql);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['Movie_index'] . "</td>";
                                echo "<td>" . $row['Title'] . "</td>";
                                echo "<td>" . $row['Trailer_link'] . "</td>";
                                echo "<td>" . $row['Release_Date'] . "</td>";
                                echo "<td>" . $row['Watch_Time'] . 'mins' . "</td>";
                                echo "<td>" . $row['MovieGenres'] . "</td>";
                                echo "<td>" . $row['MovieCasts'] . "</td>";

                                echo "<td>" . $row['Pre_sequel'] . "</td>";
                                echo "<td>" . $row['Stream_link'] . "</td>";
                            }
                            echo "</tr>";
                        }
                    }
                    if ($movieType == "all") {
                        $sql = "SELECT M.*, GROUP_CONCAT(DISTINCT G.Genre) AS MovieGenres, GROUP_CONCAT(DISTINCT C.Cast) AS MovieCasts  FROM movies M  LEFT JOIN movie_genre G 
                    ON M.Movie_index = G.Movie_index  LEFT JOIN movie_castings C ON M.Movie_index = C.Movie_index GROUP BY M.Movie_index";
                        $result = mysqli_query($db, $sql);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>"; ?>
                                <form method="POST" action="">
                                    <input type="hidden" name="movieIndex" value="<?php echo $row['Movie_index']; ?>">
                                    <?php echo "<td>" . $row['Movie_index'] . "</td>";
                                    echo "<td>" . $row['Title'] . "</td>";
                                    echo "<td>" . $row['Trailer_link'] . "</td>";
                                    echo "<td>" . $row['Release_Date'] . "</td>";
                                    echo "<td>" . $row['Watch_Time'] . 'mins' . "</td>";
                                    echo "<td>" . $row['MovieGenres'] . "</td>";
                                    echo "<td>" . $row['MovieCasts'] . "</td>";

                                    echo "<td>" . $row['Pre_sequel'] . "</td>";
                                    ?>

                                    <td>
                                    
                                    <button class="deleteBtn" name="delete" style=' background-color: red;color: white;border: none; border-radius: 4px;padding: 8px 12px; '>Delete</button>
                                        </form>
                                        <a href="edit_details.php?id=<?php echo $row['Movie_index']; ?>"target="_blank"><button style=' background-color: green;color: white;border: none; border-radius: 4px;padding: 8px 12px; '>Update</button></a>
                                    </td>
                                
                            <?php
                            if(isset($_POST['delete']) && $_POST['movieIndex'] == $row['Movie_index']){
                                $sql = "DELETE FROM movies WHERE Movie_index = '" . $_POST['movieIndex'] . "'";
                                mysqli_query($db,$sql);
                                header("Location: allmovies.php");
                                exit();
                            }
                            
                    
                                }
                            echo "</tr>";
                        }
                    }
                    if ($movieType == "") {
                        $sql = "SELECT M.*, GROUP_CONCAT(DISTINCT G.Genre) AS MovieGenres, GROUP_CONCAT(DISTINCT C.Cast) AS MovieCasts  FROM movies M  LEFT JOIN movie_genre G 
                    ON M.Movie_index = G.Movie_index  LEFT JOIN movie_castings C ON M.Movie_index = C.Movie_index GROUP BY M.Movie_index";
                        $result = mysqli_query($db, $sql);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>"; ?>
                                <form method="POST" action="">
                                    <input type="hidden" name="movieIndex" value="<?php echo $row['Movie_index']; ?>">
                                    <?php
                                    echo "<td>" . $row['Movie_index'] . "</td>";
                                    echo "<td>" . $row['Title'] . "</td>";
                                    echo "<td>" . $row['Trailer_link'] . "</td>";
                                    echo "<td>" . $row['Release_Date'] . "</td>";
                                    echo "<td>" . $row['Watch_Time'] . 'mins' . "</td>";
                                    echo "<td>" . $row['MovieGenres'] . "</td>";
                                    echo "<td>" . $row['MovieCasts'] . "</td>";

                                    echo "<td>" . $row['Pre_sequel'] . "</td>";
                                    ?>

                                    <td>
                                    <button class="deleteBtn" name="delete" style=' background-color: red;color: white;border: none; border-radius: 4px;padding: 8px 12px; '>Delete</button>
                            </form>
                            <a href="edit_details.php?id=<?php echo $row['Movie_index']; ?>"target="_blank"><button style=' background-color: green;color: white;border: none; border-radius: 4px;padding: 8px 12px; '>Update</button></a>
                                    </td>
            
                                
                        <?php
                        if(isset($_POST['delete']) && $_POST['movieIndex'] == $row['Movie_index']){
                            $sql = "DELETE FROM movies WHERE Movie_index = '" . $_POST['movieIndex'] . "'";
                            mysqli_query($db,$sql);
                            header("Location: allmovies.php");
                            exit();
                        }
                        
                
                            }
                            echo "</tr>";
                        }
                    } ?>

                        <!-- Update Movie Modal -->




                </tbody>
            </table>

        </section>
    </center>


</body>

</html>