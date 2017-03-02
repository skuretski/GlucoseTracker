<?php
ini_set('session.save_path', '../sessions');
//error_reporting(E_ALL);
//ini_set("display_errors", true);
session_start();

if(isset($_SESSION["user"])){
	header("location: yourGlucose.php");
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='CSS/jquery.datetimepicker.css'/>
	<link rel="stylesheet" type="text/css" href="CSS/style.css"/>
	<title>Sign In</title>
</head>
<body>
<h1>Sign In</h1>
	<nav>
		<ul>
			<li><a href = "index.php">Home</a></li>
			<li><a href = "yourGlucose.php">Your Glucose Log</a></li>
			<li><a href = "community.php">Our Community</a></li>
			<li><a href = "signup.php">Sign Up</a></li>
		</ul>
	</nav>
	<div id="wrapper">
	<h2>You must be signed in to access 'Your Glucose'</h2>
	<form id='login'>
		<label for='username'>Username:</label><input type='text' id='username' name='username' required/><br>
		<label for='pw'>Password:</label><input type='password' id='password' name='password' required/>
		<div id='lowerLogin'>
			<input type='submit' value='Login'/>
		</div>
		<span id='login_message'></span><br>
	</form>
	</div>
	<script type="text/javascript" src="jquery/jquery.js"></script>
	<script type='text/javascript' src="dropzone.js"></script>
	<script type="text/javascript" src="scripts.js"></script>
</body>
</html>