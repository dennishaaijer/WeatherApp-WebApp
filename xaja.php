<?php
if( isset($_POST['id']) )
{

$id = $_POST["id"];
		
		$test = "weather/history/".$id.".xml";
		
		
		$xml=simplexml_load_file($test);
		//echo $xml->
		?>