<?php

	$servername = "127.0.0.1:3306";
	$username = "root";
	$password = "";
	$conn = mysqli_connect($servername, $username, $password);
	$db = mysqli_select_db($conn,'srms');


?>