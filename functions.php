<?php 

function authorize()
	{
  		session_start();
		if (!isset($_SESSION['user']))
			{
        		header("Location: index.php");
			}
	}

function loadNavTop()
	{
		echo "
	           <nav id=\"navbar\" class=\"navbar navbar-expand-sm navbar-dark bg-success\">
		    		<a href=\"dashboard.php\" class=\"navbar-brand\">Plummy Fashions Ltd.</a>
		      		<div class=\"navbar-collapse collapse\" id=\"navbar8\">
		        		<ul class=\"navbar-nav ml-auto\">
		        	 		<li class=\"nav-item active\">
		              			<a class=\"nav-link\" href=\"#\">";
		              	echo  $_SESSION['user'];
		              	echo   "</a>
		           			</li>
		           			<li class=\"nav-item active\">
		              			<a class=\"btn btn-primary\" href=\"logout.php\" role=\"button\">Logout</a>
		            		</li>
		        		</ul>
		      		</div>
	  			</nav>
			";
	}

function importStyling()
	{
		echo "	
				<link href=\"//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css\" rel=\"stylesheet\" id=\"bootstrap-css\">
  				<link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.6.3/css/all.css\" integrity=\"
  				sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/\" crossorigin=\"anonymous\">
				<script src=\"//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js\"></script>
				<script src=\"//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>";
	}
?>