<?php 
	$servername = "localhost";
	$username = "root";
	$password = "13qe";
	$db = "tree";
	global $conn;
	$conn = new mysqli($servername, $username, $password, $db);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
?>