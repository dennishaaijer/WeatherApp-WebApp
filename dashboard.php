<?php
include "functions.php";
authorize();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<?php importStyling(); ?>
  <link rel="stylesheet" type="text/css" href="style/dashboard.css">
  <style>

  body,html {
   height: 100%;
   background-position: center;
   background-size: cover;
   background-image: url("/img/plummygarden2.jpg");
 }
  .centerit{
    text-align: center;
    margin-right:2%;
		margin-left: -10%;
  }
</style>
</head>
<body>
 <div id="sidebar_placeholder"></div>
 <script>
   $(function(){
    $("#sidebar_placeholder").load("sidebar.html");
  });
</script>
<?php loadNavTop(); ?>
<?php $user = explode('@',$_SESSION['user']); ?>
<div class="boxes">
  <div class='centerit'>
    <img src="../img/plummylogo.png" alt="">
    <h1>Welcome <?php print_r($user[0]); ?> </h1>
  </div>

</div>
</body>
</html>
