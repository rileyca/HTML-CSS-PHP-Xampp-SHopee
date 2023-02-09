<?php
    $dsn = "mysql:host=localhost; dbname=msw";
	$username = "root";
	$password = "";
	try{
		$conn = new PDO($dsn, $username, $password);
		$conn->setAttribute(PDO::ATTR_PERSISTENT, true);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$conn
           
	}catch(PDOException $ex) {
		echo "Connection error: " . $ex->getMessage();	
	}
?>