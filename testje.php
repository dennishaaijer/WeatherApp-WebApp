<?php
if( isset($_POST['id']) )
{

	$id = $_POST["id"];
	$sort = $_POST["sort"];
		
		// $test = "weather/static/".$id.".xml";
		
		// $xml=simplexml_load_file($test);
		// echo $xml->STN.',';
		// echo $xml->TEMP.',';
		// echo $xml->PRCP;

	$values = array();
	echo "<script>var values = [];</script>";
	for ($i=1; $i < 29; $i++) { 
		$date=date_create("now");
		date_sub($date,date_interval_create_from_date_string($i." days"));

		$date_string = date_format($date,"d-m-Y");

		$test = "weather/history/".$id."/".$date_string.".xml";
		$xml=simplexml_load_file($test);

		if($sort == "temp") {
			$temp_string = "".$xml->TEMP;
			$temp_string = $temp_string." graden";
			echo "<script>var value = ['".$date_string."',".$temp_string."];</script>";
			echo "<script>values.push(value);</script>";
		} elseif ($sort == "rain") {
			$temp_string = "".$xml->PRCP;
			$temp_string = $temp_string." regen";
			echo "<script>var value = ['".$date_string."',".$temp_string."];</script>";
			echo "<script>values.push(value);</script>";
		}

		//echo "<script>var value = ['".$date_string."',".$temp_string."];</script>";

	}
}
?>