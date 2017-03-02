<?php
ini_set('session.save_path', '../sessions');
//error_reporting(E_ALL);
//ini_set("display_errors", true);
session_start();

//Go back to main page if not logged in correctly.
if(!isset($_SESSION["verified"]) || empty($_SESSION["verified"])){
	header("location: signin.php");
	die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='CSS/jquery.datetimepicker.css'/>
	<link rel="stylesheet" type="text/css" href="CSS/style.css"/>
	<title>Your Glucose Keeper</title>
</head>
<body>
	<h1>Your Glucose Keeper</h1>
	<nav>
		<ul>
			<li><a href = "index.php">Home</a></li>
			<li><a href = "yourGlucose.php">Your Glucose Log</a></li>
			<li><a href = "community.php">Our Community</a></li>
			<li><a href = "signup.php">Sign Up</a></li>
		</ul>
	</nav>
	<div id='userIn'>
	</div>
	<div id="wrapper">
		<div id='welcome'>
			<h3>Welcome back! We're glad you're taking an active role in managing your 
			diabetes.</h3> 
		</div>
		<div id='manage'>
			These are some of the things you can do with this glucose tracker:
			<ul>
				<li>Log your glucose at any hour of the day whether it's 
					once or more times a day</li>
				<li>Keep track of how much insulin you use</li>
				<li>Know what insulin you used with each reading</li>
				<li>Get info for the last 30, 90, or 360 days</li>
			</ul>
		</div>
		<br><br><br>
	</div>
	<div id='wrapper'>
		<div id='results'>
		</div>
		<div>
			<form id="filter">
			<label>Filter By:</label><br/>
			<input type="radio" value="30" name="filterDays" checked>30 Days<br/>
			<input type="radio" value="90" name="filterDays">90 Days<br/>
			<input type="radio" value="360" name="filterDays">360 Days<br/>
			<input type="submit" value="Filter">
			</form>
		</div>
	</div>
	<div id="wrapper">
	<hr>
	<div id='addEntry'><h3>Add an entry here!</h3>
	<form id='log'>
		<label>Date</label>
			<input type="text" class="hasDatepicker" id="datetimepicker"/>
		<label>Glucose</label>
			<input type="number" name="glucose" id="glucose" min = 30 max = 900 required/>
			<span id="glucose_message"></span><br>
		<label>Insulin Units</label>
			<input type="number" name="units" id="units" min=0 max=200 required/>
			<span id="units_message"></span><br>
		<label>Insulin Type</label><br>
			<input type="radio" value="Novolog" name="insulins">Novolog (insulin aspart)<br/>
			<input type="radio" value="Lantus" name="insulins">Lantus (insulin glargine)<br/>
			<input type="radio" value="Apidra" name="insulins">Apidra (insulin glulisine)<br/> 
			<input type="radio" value="Humalog" name="insulins">Humalog (insulin lispro)<br/>
			<input type="radio" value="Levemir" name="insulins">Levemir (insulin detemir)<br/>
			<input type="radio" value="other" name="insulins">Other<input type="text" id="other"/>
			<span id="type_message"></span><br><br>
		<input type="submit" value="Add Entry">
	</form>
	</div>
	</div>
	</div>
	<script type='text/javascript' src="jquery/jquery.js"></script>
	<script type='text/javascript' src="dropzone.js"></script>
	<script type='text/javascript' src='scripts.js'></script>
	<script type='text/javascript' src="jquery/jquery.datetimepicker.js"></script>
	<script type="text/javascript"> jQuery(function(){
		jQuery('#datetimepicker').datetimepicker();
	});</script>
</body>
</html>

