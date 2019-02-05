<?php
if( isset($_POST['id']) )
{

$id = $_POST["id"];
		
		$test = "weather/static/".$id.".xml";
		//echo $test;
		
		$xml=simplexml_load_file($test);
		//echo "<br>";
		//echo '<script>var temp = eval('.$xml->TEMP.');</script>';
		//echo '<script>var testi = eval("TESTINGTESTING");</script>';
		//echo 'var temp ='.$xml->TEMP.';
		//var rain ='. $xml->PRCP.';';
		//echo "<br>";
		echo $xml->STN.',';
		echo $xml->TEMP.',';
		echo $xml->PRCP;
		//echo 'var rain ='.$xml->PRCP.';';
		//echo '<script> var temp = '.$xml->TEMP.';</script>';
		//echo '<script> var rain = '.$xml->PRCP.';</script>';
		//echo 'script>var arr = ["'.$xml->TEMP.'","'.$xml->PRCP.'"];</script>';
		//echo 'script>tempa = arr[0];</script>';
		//echo 'script>rain = arr[1];</script>';
	}
		?>