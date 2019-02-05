<?php

$servername = "localhost";
$username = "root";
$password = "tTPhN9AZ&6Y&VeYi&p";
$db = "unwdmi";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT stn, name, latitude, longitude, country FROM stations WHERE country = 'BURMA'
	OR country = 'CHINA'
	OR country = 'INDIA'";

$res = $conn->query($sql);

while($row = $res->fetch_assoc()){
    echo'
			var arr = ["'.$row["stn"].'","'.$row["name"].'","'.$row["latitude"].'","'.$row["longitude"].'","'.$row["country"].'"];
			coords.push(arr);
		 '
    ;}

?>