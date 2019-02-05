<?php 
function login(){
	$userN = trim($_POST['username']);
	$passW = hash('sha256' , $_POST['password']);
	$userlist = file ('users.txt');
	$success = false;
	foreach ($userlist as $user) {
	    $user_details = explode('|', $user);
	    if (trim($user_details[0]) == $userN && trim($user_details[1]) == $passW) {
	        $success = true;
	        break;
	    }
	}
	if ($success) {
	    $_SESSION["auth"] = true;
        $_SESSION["timeout"]=time() + 120;
        $_SESSION["user"]= $userN;
        header("Location: dashboard.php");
	} else {
	    echo "<br> <small style=\"color:red;\">You have entered the wrong username or password. Please try again. </small><br>";
	}
}

 ?>