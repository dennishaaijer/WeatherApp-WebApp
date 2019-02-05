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
</head>
</head>
<body>

	<div id="sidebar_placeholder"></div>
	<script>
		$(function(){
			$("#sidebar_placeholder").load("sidebar.html");
		});
	</script>

	<?php loadNavTop(); ?>

	<div class="boxes">
		<h1>Data Export</h1><br />
		<form>
			<input type="button" style='height:50px;' value="Export ALL Weatherdata" class="btn btn-primary btn-block btn-xl" onclick="window.location.href='download.php?l=ALL'" /> <br />
			<table class='table export'>
				<tr>
					<td>United States</td>
					<td>Myanmar</td>
				</tr>
				<tr>
					<td><input type="button" value="Export US Weatherdata" class="btn btn-primary btn-block btn-xl" onclick="window.location.href='download.php?l=US'" /></td>
					<td><input type="button" value="Export MM Weatherdata" class="btn btn-primary btn-block btn-xl" onclick="window.location.href='download.php?l=BU'" /></td>
				</tr>
				<tr>
					<td>China</td>
					<td>France</td>
				</tr>
				<tr>
					<td><input type="button" value="Export CH Weatherdata" class="btn btn-primary btn-block btn-xl" onclick="window.location.href='download.php?l=CH'" /></td>
					<td><input type="button" value="Export FR Weatherdata" class="btn btn-primary btn-block btn-xl" onclick="window.location.href='download.php?l=FR'" /></td>
				</tr>
				<tr>
					<td>Germany</td>
					<td>India</td>
				</tr>
				<tr>
					<td><input type="button" value="Export GE Weatherdata" class="btn btn-primary btn-block btn-xl" onclick="window.location.href='download.php?l=GE'" /></td>
					<td><input type="button" value="Export IN Weatherdata" class="btn btn-primary btn-block btn-xl" onclick="window.location.href='download.php?l=IN'" /></td>
				</tr>
				<tr>
					<td>Spain</td>
					<td>United Kingdom</td>
				</tr>
				<tr>
					<td><input type="button" value="Export SP Weatherdata" class="btn btn-primary btn-block btn-xl" onclick="window.location.href='download.php?l=SP'" /></td>
					<td><input type="button" value="Export UK Weatherdata" class="btn btn-primary btn-block btn-xl" onclick="window.location.href='download.php?l=UK'" /></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>
