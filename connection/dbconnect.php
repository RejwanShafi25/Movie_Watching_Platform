<?php
//Connecting to database
$servername="localhost";//server
$username="root"; //username
$password="";//password
$dbname="online_movie_watching_platform";//database

//Connection
$db=mysqli_connect($servername,$username,$password,$dbname);//Connecting to Server

//check connection 
if($db->connect_error){
	die("Connection failed: " . $db->connect_error);
	}
else{
	mysqli_select_db($db, $dbname);
	//echo "Connection successful";
	}


?>