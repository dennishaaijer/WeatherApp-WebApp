<html>
<head>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<script type="text/javascript">
		function showdata() {
			for (var i = 0; i < values.length; i++) {
				$("#show").append(values[i][0]);
				$("#show").append(" , ");
				$("#show").append(values[i][1]);
				$("#show").append("<br>");
			}
		}

		function test() {
			$("#show").empty();
		station = $("#station").val();
		$.ajax({
                type: 'post',
                url: 'get_history.php',
                data: {
                    id: station
                },
                success: function(data)
                {
                	$("#data").html(data);
                	showdata();
                }  
            
          });
		}
	</script>
	<input type="text" name="staion" id="station">
	<button onclick="test()">Click me</button>
	<div id="data"></div>
	<div id="show"></div>
</body>
</html>