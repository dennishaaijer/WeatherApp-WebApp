<?php
      include "functions.php";
      authorize();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rainfall</title>
    <?php importStyling(); ?>
    <link rel="stylesheet" type="text/css" href="style/dashboard.css">
    <style>
        h1{
            padding-bottom: 5%;
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


<div class="content">

<h2>Top China</h2>

<table class="table table-striped" id="showch">
  
</table>
</div>

<div class="content">

<h2>Top India</h2>

<table class="table table-striped" id="showin">
  
</table>
</div>

<div class="content">

<h2>Top Myanmar</h2>

<table class="table table-striped" id="showmm">
  
</table>
</div>

<script>

    var chcoords = [];
    var incoords = [];
    var mmcoords = [];

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

        if ($row['country'] == 'CHINA'){

            echo'
            var arr = ["'.$row["stn"].'","'.$row["name"].'","'.$row["country"].'",""];
            chcoords.push(arr);
         ';

        }

        if ($row['country'] == 'INDIA'){

            echo'
            var arr = ["'.$row["stn"].'","'.$row["name"].'","'.$row["country"].'",""];
            incoords.push(arr);
         ';

        }

        if ($row['country'] == 'BURMA'){

            echo'
            var arr = ["'.$row["stn"].'","'.$row["name"].'","'.$row["country"].'",""];
            mmcoords.push(arr);
         ';

        }
    }

    ?>


    var chstations = {};
    var instations = {};
    var mmstations = {};

    for (var i in chcoords){
        var stat = chcoords[i][0];
        //console.log(coords[i][0]);
        var name = chcoords[i][1];
        chstations[this.stat] = this.name;
    }

    for (var i in incoords){
        var stat = incoords[i][0];
        //console.log(coords[i][0]);
        var name = incoords[i][1];
        instations[this.stat] = this.name;
    }

    for (var i in mmcoords){
        var stat = mmcoords[i][0];
        //console.log(coords[i][0]);
        var name = mmcoords[i][1];
        mmstations[this.stat] = this.name;
    }

    for (var i in chcoords){
        $.ajax({
                type: 'post',
                url: 'top.php',
                data: {
                    id: chcoords[i][0]
                },
                success: function(data)
                {
                      res = data.split(',');
                      station = res[0];
                      rain = res[1];
                    //console.log(data);
                    //console.log(station);
                    chass(station, rain);
                    //var arr = [coords[i][0], coords[i][1],coords[2],data];
                    //rf.push(arr);

                }

          });
    }

    for (var i in incoords){
        $.ajax({
                type: 'post',
                url: 'top.php',
                data: {
                    id: incoords[i][0]
                },
                success: function(data)
                {
                      res = data.split(',');
                      station = res[0];
                      rain = res[1];

                    //console.log(data);
                    //console.log(station);
                    inass(station, rain);
                    //var arr = [coords[i][0], coords[i][1],coords[2],data];
                    //rf.push(arr);

                }

          });
    }



    for (var i in mmcoords){
        $.ajax({
                type: 'post',
                url: 'top.php',
                data: {
                    id: mmcoords[i][0]
                },
                success: function(data)
                {
                      res = data.split(',');
                      station = res[0];
                      rain = res[1];
                    //console.log(data);
                    //console.log(station);
                    mmass(station, rain);
                    //var arr = [coords[i][0], coords[i][1],coords[2],data];
                    //rf.push(arr);

                }

          });
    }

var rfch = [];
var rfin = [];
var rfmm = [];



function chass(station, rain){

    var station = station;
    var rain = rain;
    var s = [rain, station];
    rfch.push(s);
}

function inass(station, rain){

    var station = station;
    var rain = rain;
    var s = [rain, station];
    //console.log(s);
    rfin.push(s);
}

for (var i in rfin){
    console.log(rfin[i]);
}

function mmass(station, rain){

    var station = station;
    var rain = rain;
    var s = [rain, station];
    rfmm.push(s);
}

console.log(rfch);

setTimeout(testch, 2000);
setTimeout(testin, 2000);
setTimeout(testmm, 2000);

function testch(){

     sortedch = rfch.sort(sortFunction);

        function sortFunction(a,b) {
            if (a[0] === b[0]) {
                return 0;
            }
            else {
                return (a[0] < b[0]) ? -1 : 1;
            }
        }
        showdatach(sortedch,chcoords);
}

function testin(){ 
     sortedin = rfin.sort(sortFunction);


        function sortFunction(a,b) {
            if (a[0] === b[0]) {
                return 0;
            }
            else {
                return (a[0] < b[0]) ? -1 : 1;
            }
        }
        console.log(sortedin);

    //console.log(sorted);
    showdatain(sortedin,incoords);
   

}

function testmm(){

     sortedmm = rfmm.sort(sortFunction);

        function sortFunction(a,b) {
            if (a[0] === b[0]) {
                return 0;
            }
            else {
                return (a[0] < b[0]) ? -1 : 1;
            }
        }

    //console.log(sorted);
    showdatamm(sortedmm,mmcoords);


}


function showdatach(sortedch,chcoords) {
            var sortedch = sortedch;
            var x = 1;
            for (var i = sortedch.length - 1; i > sortedch.length - 11;  i--) {
                    $("#showch").append("<tr><td class='td1'>"+x+"</td><td class='td2'>"+chstations[sortedch[i][1]]+"</td><td class='td3'>"+String(sortedch[i][0]).concat(' mm')+"</td></tr>");
                    x++;

            }
            }

function showdatain(sortedin,incoords) {
            var sortedin = sortedin;
            var x = 1;
            for (var i = sortedin.length - 1; i > sortedin.length - 11;  i--) {
                    $("#showin").append("<tr><td class='td1'>"+x+"</td><td class='td2'>"+instations[sortedin[i][1]]+"</td><td class='td3'>"+String(sortedin[i][0]).concat(' mm')+"</td></tr>");
                    x++;

            }
            }

function showdatamm(sortedmm,mmcoords) {
            var sortedmm = sortedmm;
            var x = 1;
            for (var i = sortedmm.length - 1; i > sortedmm.length - 11;  i--) {
                    $("#showmm").append("<tr><td class='td1'>"+x+"</td><td class='td2'>"+mmstations[sortedmm[i][1]]+"</td><td class='td3'>"+String(sortedmm[i][0]).concat(' mm')+"</td></tr>");
                    x++;

            }
            }




</script>
</body>
</html>
