<?php 
session_start();
if (!isset($_SESSION['user'])){
	header("Location: index.php");
}

echo "Logged in as: ". $_SESSION['user'];
echo "<br><a href=\"logout.php\">Logout</a>";
 ?>