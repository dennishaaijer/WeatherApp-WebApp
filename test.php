<?php

$servername = "localhost";
	$username = "root";
	$password = "tTPhN9AZ&6Y&VeYi&p";

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}


	$sql = "

CREATE TABLE tabelletje(
rij varchar(255);
);

";
if ($conn->query($sql) === TRUE) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . $conn->error;
	}

	$conn->close();



?>