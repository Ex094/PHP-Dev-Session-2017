<?php 

//Connection to the Database BLOG
$conn = @mysqli_connect("localhost", "root", "", "blog");

if(!$conn) {
	die("Error:" . mysqli_connect_error());
}

return $conn;