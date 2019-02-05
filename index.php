<?php session_start();
 if (isset($_SESSION['user'])) {
 	header("Location: dashboard.php");
 }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Weather Application</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="style/index.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<?php include 'login.php' ?>
	<div id="login">
    <img src="img/plummylogo.png" class="center">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div class="login-box col-md-12">
                    <form id="login-form" class="form" action="index.php" method="post">
                        <h3 class="text-center text-success">Login</h3>
                        <div class="form-group">
                            <label for="username" class="text-success">Username</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-success">Password</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="Submit" class="btn btn-success btn-md" value="Submit">
                           <?php                   
								if (isset($_POST['username']) && isset($_POST['password'])){
									login();
								}
			               ?> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>