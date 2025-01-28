<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
include("connection/dbconnect.php");  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed

$searchTerm = mysqli_real_escape_string($db, $_POST['search']);

$sql = "SELECT * FROM movies WHERE Title LIKE '%$searchTerm%'";

$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    //here we will print every row that is returned by our query $sql
    while ($movie = mysqli_fetch_array($result)) {
        //here we have to write some HTML code, so we will close php tag
?>
        <div class="container text-center">
            <div class="row row-cols-3" style="padding-bottom: 0%;">
                <div class="col-4">
                    <div class="card" style="size:0cap">
                        <a class="nav-link" href="movies.php?id=<?php echo $movie['Movie_index']; ?>"><img src="<?php echo $movie['CImage']; ?>" class="card-img-top"></a>
                        <div class="card-body">
                            <a class="nav-link" href="movies.php?id=<?php echo $movie['Movie_index']; ?>">
                                <h5 class="card-title"><?php echo $movie['Title'] ?></h5>
                            </a>
                        </div>
                    </div><br /><br /><br />
                </div>
            </div>
        </div>

<?php
    }
}
?>
