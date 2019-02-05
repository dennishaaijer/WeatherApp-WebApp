<?php 
      include "functions.php";
      authorize(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>History</title>
	<?php importStyling(); ?>
  <link rel="stylesheet" type="text/css" href="style/dashboard.css">
</head>
<body>
	
  <div id="sidebar_placeholder"></div>
    <script>
  $(function(){
      $("#sidebar_placeholder").load("sidebar.html");
  });
  </script>
  <?php loadNavTop(); ?>

  <div class="content">
    <img src="img/graph.png" height="600px">
  </div>

</body>
</html>