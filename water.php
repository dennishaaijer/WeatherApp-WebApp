<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title></title>
</head>
<body>

<table>
	<div id="show"></div>

</table>

<script>

	var coords = [];

<?php

	$servername = "localhost";
	$username = "root";
	$password = "tTPhN9AZ&6Y&VeYi&p";
	$db = "unwdmi";

	$conn = new mysqli($servername, $username, $password, $db);

	if ($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT stn, name, country FROM stations WHERE country = 'BURMA'
	OR country = 'CHINA'
	OR country = 'INDIA'";

	$res = $conn->query($sql);

	$lis = [];
	
	while($row = $res->fetch_assoc()){
		
		echo'
			var arr = ["'.$row["stn"].'","'.$row["name"].'","'.$row["country"].'",""];
			coords.push(arr);
		 '
		 ;}

		
	?>


	var stations = {};
	var country = {};

	for (var i in coords){
		var stat = coords[i][0];
		//console.log(coords[i][0]);
		var name = coords[i][1];
		stations[this.stat] = this.name;	
	}

	for (var i in coords){
		var stat = coords[i][0];
		//console.log(coords[i][0]);
		var name = coords[i][2];
		country[this.stat] = this.name;	
	}


	for (var i in coords){
		$.ajax({
                type: 'post',
                url: 'top.php',
                data: {
                    id: coords[i][0]
                },
                success: function(data)
                {
                	  res = data.split(',');
	                  station = res[0];
	                  rain = res[1];
                	//console.log(data);
                	//console.log(station);
                	ass(station, rain);
                	//var arr = [coords[i][0], coords[i][1],coords[2],data];
                	//rf.push(arr);
                	
                }  
            
          });
	}

var rf = [];



function ass(station, rain){

	var station = station;
	var rain = rain;
	var s = [rain, station];
	rf.push(s);
}

setTimeout(test, 3000);

function test(){

	 sorted = rf.sort(sortFunction);

		function sortFunction(a,b) {
		    if (a[0] === b[0]) {
		        return 0;
		    }
		    else {
		        return (a[0] < b[0]) ? -1 : 1;
		    }
		}

	//console.log(sorted);
	showdata(sorted,coords);

}


function showdata(sorted,coords) {
			var x = 1;
			for (var i = sorted.length - 1; i > sorted.length - 11;  i--) {
					$("#show").append("<tr><td>"+x+"</td><td>"+country[sorted[i][1]]+"</td><td>"+stations[sorted[i][1]]+"</td><td>"+String(sorted[i][0]).concat(' mm')+"</td></tr>");
					x++;

			}
			}
			
		

</script>


</body>
</html>