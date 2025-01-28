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
if (isset($_POST["submit"])) {
    $genres = $_POST["genre"];
    $casts = $_POST["cast"];
    $title = $_POST["title"];
    $storyline = $_POST["storyline"];
    $release_date = $_POST["Release_date"];
    $trailer = $_POST["trailer"];
    $watch_time = $_POST["watch_time"];
    $country = $_POST["country"];
    $cover = $_POST["cover"];
    $prequel = $_POST["prequel"];
    //$num_genres = $_POST["num_genres"];
    //$num_casts = $_POST["num_casts"];
    $is_old = isset($_POST["is_old"]) ? 1 : 0;
    $message = "";
    $stmt = $db->prepare("INSERT INTO movies (Title, Summary, Release_Date, Trailer_link, Watch_Time, Country, CImage, Pre_sequel) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $_POST["title"], $_POST["storyline"], $_POST["Release_date"], $_POST["trailer"], $_POST["watch_time"], $_POST["country"], $_POST["cover"], $_POST["prequel"]);
    $stmt->execute();

    $movie_id = mysqli_insert_id($db);

    $sql = "INSERT INTO movie_genre VALUES";

    for ($i = 0; $i < count($genres); $i++) {

        $sql .= "($movie_id,'" . $genres[$i] . "'),";
    }

    $sql = rtrim($sql, ",");

    mysqli_query($db, $sql);

    $sql = "INSERT INTO movie_castings VALUES";

    for ($i = 0; $i < count($casts); $i++) {

        $sql .= "($movie_id,'" . $casts[$i] . "'),";
    }

    $sql = rtrim($sql, ",");

    mysqli_query($db, $sql);

    if ($_POST['is_old']) {

        $stream_link = $_POST['stream_link'];

        // Insert for old movie  
        $stmt = $db->prepare("INSERT INTO old_movies (Movie_index, Stream_link) VALUES (?, ?)");
        $stmt->bind_param("is", $movie_id, $stream_link);
        $stmt->execute();
    } else {

        // Insert for new movie
        $stmt = $db->prepare("INSERT INTO new_movies (Movie_index) VALUES (?)");
        $stmt->bind_param("i", $movie_id);
        $stmt->execute();
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

    <div class="container text-center">
        <div class="row">
            <div class="col-md-12" style="background-color:#E4DCCF; opacity:1; color: black; font-family: Arial, Helvetica, sans-serif; font-size: medium;">
                <br /><br />
                <div class="row">
                        <div class="form-group col-sm-8" style="font-size: 21px;">
                            Add A movie to the website
                        </div>
                    </div><br />
                <br />
                <form action="" method="post">
                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label for="exampleInputEmail1" style="font-size: 21px;">Title</label>
                            <input class="form-control" type="text" name="title">
                        </div>
                    </div><br /><br />

                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label style="font-size: 21px;">Storyline</label>
                            <input class="form-control" type="text" name="storyline" maxlength="4000">

                        </div>
                    </div><br /><br />

                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label for="exampleInputEmail1" style="font-size: 21px;">Release Date</label>
                            <input class="form-control" type="text" name="Release_date">
                        </div>
                    </div><br /><br />

                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label for="exampleInputEmail1" style="font-size: 21px;">Trailer Link</label>
                            <input class="form-control" type="text" name="trailer">
                        </div>
                    </div><br /><br />

                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label for="exampleInputEmail1" style="font-size: 21px;">Watch Time</label>
                            <input class="form-control" type="text" name="watch_time">
                        </div>
                    </div><br /><br />

                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label for="exampleInputEmail1" style="font-size: 21px;">Country</label>
                            <input class="form-control" type="text" name="country">
                        </div>
                    </div><br /><br />

                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label for="exampleInputEmail1" style="font-size: 21px;">Cover Image</label>
                            <input class="form-control" type="text" name="cover">
                        </div>
                    </div><br /><br />

                    <div class="row">
                        <div class="form-group col-sm-8">
                            <label for="exampleInputEmail1" style="font-size: 21px;">Prequel</label>
                            <input class="form-control" type="text" name="prequel">
                            <div>
                            </div><br /><br />

                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label for="exampleInputEmail1" style="font-size: 21px;">Number of Genres</label>
                                    <input class="form-control" type="text" name="num_genres" id="num_genres">
                                </div>
                            </div><br /><br />
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <div id="genre_fields"></div>
                                </div>
                            </div><br /><br />

                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label for="exampleInputEmail1" style="font-size: 21px;">Number of Casts</label>
                                    <input class="form-control" type="text" name="num_casts" id="num_casts">
                                </div>
                            </div><br /><br />

                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <div id="cast_fields"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <div class="form-check">
                                        <label class="form-check-label" for="is_old" style="font-size: 21px;">Old Movie?</label>
                                        <input class="form-check-input" type="checkbox" name="is_old" id="is_old">
                                    </div>
                                </div>
                            </div><br /><br />

                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label for="exampleInputEmail1" style="font-size: 21px;">Stream Link </label>
                                    <input class="form-control" type="text" name="stream_link">
                                </div>
                            </div><br /><br />

                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <p> <input type="submit" value="Submit" name="submit"> </p>
                                </div>
                            </div><br /><br />
                </form>

            </div>
            
        </div>
    </div>

    <script>
        // Get input fields
        const numGenres = document.getElementById("num_genres");
        const genreContainer = document.getElementById("genre_fields");

        const numCasts = document.getElementById("num_casts");
        const castContainer = document.getElementById("cast_fields");

        // Listen for input events
        numGenres.addEventListener("input", () => {
            addFields(numGenres.value, genreContainer, "Genre");
        });

        numCasts.addEventListener("input", () => {
            addFields(numCasts.value, castContainer, "Cast");
        });

        // Create fields  
        function addFields(count, container, label) {
            container.innerHTML = "";

            for (let i = 0; i < count; i++) {
                let input = document.createElement("input");
                input.name = label.toLowerCase() + "[]";

                let labelElement = document.createElement("label");
                labelElement.innerHTML = `${label} ${i + 1}:`;

                container.appendChild(labelElement);
                container.appendChild(input);
                container.innerHTML += "<br/><br/>";
            }
        }
    </script>


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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-9aIy9QHo3Y9ccay3Ln3IYv64bY38s26cO1bq7e6DZjISe0VzpXIdWu93z5h/iqY" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy4yIf0AqOO5P4hZ8afRgppQ06jYz8AsjG" crossorigin="anonymous"></script>


</body>

</html>