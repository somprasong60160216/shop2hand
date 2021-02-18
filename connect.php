<?php
	$conn= mysqli_connect("localhost","root","","my_db") or die("Error: " . mysqli_error($con));
	mysqli_query($conn, "SET NAMES 'utf8' "); 
?>