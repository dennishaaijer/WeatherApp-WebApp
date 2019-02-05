<?php
include "functions.php";
authorize();
?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <?php importStyling(); ?>
    <link rel="stylesheet" type="text/css" href="style/dashboard.css">
  <meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="-1" />
	<title></title>
	<style>

	html, body, #mapholder{
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    position: absolute;
  }
.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
}
.content {
  background-color: white;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  border: 1px solid black;
  border-radius: 10px;
  height:auto;
}
.content h1,h2{
	color: black;
	font-family: helvetica;
	text-align: center;
}
.content p{
	font-family: helvetica;
}
.content hr{
	stroke-color: brown;
}
.close{
	float: right;
	width: 20px;
	height: 20px;
}
.tabel {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.tabel td, .tabel th {
  border: 1px solid #ddd;
  padding: 3px;
}

.tabel tr:nth-child(even){background-color: #f2f2f2;}

.tabel tr:hover {background-color: #ddd;}

.tabel th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
        
#map{
    height: 91%;
    width:87%;
    margin-left:13%;
    position:absolute;
    float:center;
}

    @media (min-height: 1500px;) {
        #map{
            height: 93%;
        }
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


<?php
function mindate(){
$date = date('Y-m-d');
$mdate = date('Y-m-d', strtotime('-28 days', strtotime($date)));
echo $mdate;
}

function maxdate(){
$date = date('Y-m-d');
$mdate = date('Y-m-d', strtotime('-1 day', strtotime($date)));
echo $mdate;
}
?>

<div id="modal" class="modal">
		<div class="content">
			<a href="javascript:close();">
				<span class="close">&times;</span>
			</a>
			<h1 id="station"></h1>
      <hr>
			<p id="meas"></p>
			<p id='temp'></p>
		<hr>
		<h2>History</h2>

		<div id="show">
			

		</div>
		</div>
	</div>


<div id="data"></div>


<div id="map">
	<div id="mapholder"></div>
</div>


<div id="testy">
  
</div>
	
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

	$sql = "SELECT stn, name, latitude, longitude, country FROM stations WHERE country = 'BURMA'
	OR country = 'UNITED STATES'
	OR country = 'SPAIN'
	OR country = 'FRANCE'
	OR country = 'CHINA'
	OR country = 'UNITED KINGDOM'
	OR country = 'INDIA'
	OR country = 'GERMANY'";

	$res = $conn->query($sql);
	
	while($row = $res->fetch_assoc()){
		if($row['station'] != '85480'){
		echo'
			var arr = ["'.$row["stn"].'","'.$row["name"].'","'.$row["latitude"].'","'.$row["longitude"].'","'.$row["country"].'"];
			coords.push(arr);
		 '
	;}
	}
	?>


	var markers = [];
	var temps = {};

	for (var i = 0; i < coords.length; i++){
		var station = coords[i][0];
		temps[station] = [coords[i][4], '']; 
	}

	for(var i in coords){
		 station = coords[i][0];
    //console.log(station);
 
    function getstat(station){
      var station = this.station;
      //console.log(station);
	       $.ajax({
                type: 'post',
                url: 'ajax.php',
                data: {
                    id: station
                },
                success: function(data)
                {
                  res = data.split(',');
                  station = res[0];
                  temp = res[1];
                  rain = res[2];
                  //console.log(station,temp,rain);
                  getval(station, temp, rain);
                }  
            
          });
       }

       getstat(station);
  }

    function getval(station, temp, rain){
      var station = station;
      var temp = temp;
      var rain = rain;
     // console.log(station,temp,rain);
      //console.log(station);
      // console.log(data);
      // console.log(station);
      // console.log(temps[station][0]);
		if (temps[station][0] == 'UNITED STATES'){
			temps[station][1] = temp;
		}
		else if (temps[station][0] == 'SPAIN'){
			temps[station][1] = temp;
		}
		else if (temps[station][0] == 'GERMANY'){
			temps[station][1] = temp;
		}
		else if (temps[station][0] == 'FRANCE'){
			temps[station][1] = temp;
		}
		else if (temps[station][0] == 'UNITED KINGDOM'){
			temps[station][1] = temp;
		}
		else if (temps[station][0] == 'CHINA'){
			temps[station][1] = rain;
		}
		if (temps[station][0] == 'INDIA'){
			temps[station][1] = rain;
		}
		if (temps[station][0] == 'BURMA'){
			temps[station][1] = rain;
		}
	//console.log(temps[station]);
  }


	function createMap(){
			var start = {lat: 0, lng: 0};
			var map = new google.maps.Map(
				document.getElementById('mapholder'), {zoom: 2, center: start});

			for (var i = 0; i < coords.length; i++){
				var stat = coords[i][0];
				var marker = coords[i][0];
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(coords[i][2], coords[i][3]), map: map, label: coords[i][1]
      });
      marker.set("id",stat);
      marker.setVisible(false);
      //console.log(temps[coords[i][0]]);
      
      google.maps.event.addListener(marker, 'click', function(){
  		popup(this.label, this.id)
      })

      markers.push(marker); 

		}

		function showdata(sort) {
			if (sort == 'temp'){
						$("#show").append("<table id='tabel' class='tabel'><th>Date</th><th>Average temp.</th>");
					for (var i = 0; i < values.length; i++) {
						$("#tabel").append("<tr><td>"+values[i][0]+"</td><td>"+values[i][1]+" &#176;C</td></tr>");
					}
					$("tabel").append("</table>");
			}
			if( sort == 'rain'){
						$("#show").append("<table id='tabel' class='tabel'><th>Date</th><th>Average rain.</th>");
					for (var i = 0; i < values.length; i++) {
						$("#tabel").append("<tr><td>"+values[i][0]+"</td><td>"+values[i][1]+" mm</td></tr>");
					}
			$("tabel").append("</table>");
			}
			// $("#show").append("<table id='tabel' class='tabel'><th>Date</th><th>Temp</th>");
			// for (var i = 0; i < values.length; i++) {
			// 	$("#tabel").append("<tr><td>"+values[i][0]+"</td><td>"+values[i][1]+" &#176;C</td></tr>");
			// }
			// $("tabel").append("</table>");
		}
		

		function popup(loc, temp){	
			$("#show").empty();
			modal.style.display = "block";
			var mes = temps[temp][1];
			//mes = parseInt(mes, 10);
			//mes = parseFloat(mes).toFixed(2);
			if(temps[temp][0] == 'CHINA'){
				mes = mes*10;
				mes = parseFloat(mes).toFixed(2);
				document.getElementById("meas").innerHTML = " Current rainfall:";
				var fingra = mes.concat(" mm");
				kind = "rain";
			}
			if(temps[temp][0] == 'INDIA'){
				mes = mes*10;
				mes = parseFloat(mes).toFixed(2);
				document.getElementById("meas").innerHTML = " Current rainfall:";
				var fingra = mes.concat(" mm");
				kind = "rain";
			}
			if(temps[temp][0] == 'BURMA'){
				mes = String(mes*10);
				mes = parseFloat(mes).toFixed(2);
				document.getElementById("meas").innerHTML = " Current rainfall:";
				var fingra = mes.concat(" mm");
				kind = "rain";
			}
			if(temps[temp][0] == 'UNITED STATES'){
				document.getElementById("meas").innerHTML = "Current temperature:";
				var fingra = mes.concat(" °C");
				kind = "temp";
			}
			if(temps[temp][0] == 'SPAIN'){
				document.getElementById("meas").innerHTML = "Current temperature:";
				var fingra = mes.concat(" °C");
				kind = "temp";
			}
			if(temps[temp][0] == 'FRANCE'){
				document.getElementById("meas").innerHTML = "Current temperature:";
				var fingra = mes.concat(" °C");
				kind = "temp";
			}
			if(temps[temp][0] == 'GERMANY'){
				document.getElementById("meas").innerHTML = "Current temperature:";
				var fingra = mes.concat(" °C");
				kind = "temp";
			}
			if(temps[temp][0] == 'UNITED KINGDOM'){
				document.getElementById("meas").innerHTML = "Current temperature:";
				var fingra = mes.concat(" °C");
				kind = "temp";
			}
			document.getElementById("station").innerHTML = loc;
			document.getElementById("temp").innerHTML = fingra;

			$.ajax({
                type: 'post',
                url: 'histo.php',
                data: {
                    id: temp,
                    sort: kind
                },
                success: function(data,sort)
                {
                	var sort = kind;
                	$("#data").html(data);
                	console.log(sort);
                	showdata(sort);
                }  
            
          });
		}
		
		// var markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

		setInterval( function() { setVis(map,markers); },10000);
	}

	var x = 0;

	function setVis(map,markers){
		var map = map;
		console.log(x);
		if(x==0){
		var markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
	}
		x++;
		var markers = markers;
		for (var i in markers){
			//.log(temps[markers[i].id][1]);
				if(temps[markers[i].id][0] == 'UNITED STATES'){
					if(temps[markers[i].id][1] < 10 || temps[markers[i].id][1] > 25){
						markers[i].setVisible(false);
						markerCluster.removeMarker(markers[i], true);
					}
					else{
						markers[i].setVisible(true);
						markerCluster.addMarker(markers[i], true);
					}
				}
				if(temps[markers[i].id][0] == 'FRANCE'){
					if(temps[markers[i].id][1] < 10 || temps[markers[i].id][1] > 25){
						markers[i].setVisible(false);
						markerCluster.removeMarker(markers[i], true);
					}
					else{
						markers[i].setVisible(true);
						markerCluster.addMarker(markers[i], true);
					}
				}
				if(temps[markers[i].id][0] == 'SPAIN'){
					if(temps[markers[i].id][1] < 10 || temps[markers[i].id][1] > 25){
						markers[i].setVisible(false);
						markerCluster.removeMarker(markers[i], true);
					}
					else{
						markers[i].setVisible(true);
						markerCluster.addMarker(markers[i], true);
					}
				}
				if(temps[markers[i].id][0] == 'GERMANY'){
					if(temps[markers[i].id][1] < 10 || temps[markers[i].id][1] > 25){
						markers[i].setVisible(false);
						markerCluster.removeMarker(markers[i], true);
					}
					else{
						markers[i].setVisible(true);
						markerCluster.addMarker(markers[i], true);
					}
				}
				if(temps[markers[i].id][0] == 'UNITED KINGDOM'){
					if(temps[markers[i].id][1] < 10 || temps[markers[i].id][1] > 25){
						markers[i].setVisible(false);
						markerCluster.removeMarker(markers[i], true);
					}
					else{
						markers[i].setVisible(true);
						markerCluster.addMarker(markers[i], true);
					}
				}
				if(temps[markers[i].id][0] == 'CHINA'){
						markers[i].setVisible(true);
				}
				if(temps[markers[i].id][0] == 'BURMA'){
						markers[i].setVisible(true);
				}
				if(temps[markers[i].id][0] == 'INDIA'){
						markers[i].setVisible(true);
				}

		}
	}


	function close(){
			modal.style.display = "none";
		}

	</script>

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALJZuq_Fj4K-NYoFqE5tOhW4vPiY5nHr8&callback=createMap&language=en"></script>

</script>

</body>
</html>

