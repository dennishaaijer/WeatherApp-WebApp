<?php 
      include "functions.php";
      authorize(); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Temperature</title>
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
    <a href='europe.html'>
    <div id="content_item">
      <img class='landimg' src='img/Europe.jpeg'>
      <div id="item_title"><p>Europe</p></div>
    </div>
    </a>
    <a href='usa.html'>
    <div id="content_item">
      <img class='landimg' src='img/Usa.jpeg'>
      <div id="item_title"><p>United States</p></div>
    </div>
    </a>
  </div>
</div>
</body>
</html>