<?php
ini_set('session.save_path', '../sessions');
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();

if(session_status() == PHP_SESSION_ACTIVE){
	if(isset($_GET["logout"]) && $_GET["logout"] == true){
		session_destroy();
		$filePath = explode('/', $_SERVER['PHP_SELF'],-1);
		$filePath = implode('/', $filePath);
		$redirect = "https://" . $_SERVER['HTTP_HOST'] . $filePath;
		header("Location: index.php");
		die();
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="CSS/style.css"/>
	<title>Glucose Keeper</title>
</head>
<body>
	<h1>Glucose Keeper</h1>
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
	<div>
		<form id='login'>
			<label for="username">Username:</label><input type="text" id="username" name="username" required/><br>
			<label for="pw">Password:</label><input type="password" id="password" name="password" required/>
			<div id="lowerLogin">
				<input type="submit" value="Login"/>
			</div>
		<span id="login_message"></span><br>
		</form>
	</div>
	<div id="wrapper">
		<h2>Welcome to Glucose Keeper</h2>
	<div id="welcome"><em>Almost 30 million Americans</em> are diagnosed with diabetes. One of the 
		best ways to keep diabetes in check is to track your glucose levels. By
		trending your glucose levels, you can gain insight on how well your diabetes 
		is managed, and you keep a tight leash on that A1C goal so you're not surprised 
		when you see the doctor! 
	</div>
	<div id="purpose"><h2>Purpose of Glucose Keeper</h2>The purpose of Glucose Keeper is 
		to keep a log of your blood glucose so all of your readings are in one neat, little 
		space. We'll keep track of important details so you don't have to, such as:
		<ul id="purpose_list"> 
			<li>Glucose</li> 
			<li>Time of Day of Reading</li>
			<li>Insulin Units Given</li>
			<li>Type of Insulin</li>
		</ul>
	</div>
	<div id="how_to"><h2>How to Use This Website</h2>All you need to do is make a user 
		account and password. All the information you store will be private. Once you 
		start putting in your glucose and insulin data, we'll keep track of it for you 
		and then you can retrieve the information within the last 30, 90, or 360 days. 
		Share these results with your doctor and other health care professionals to 
		help keep your diabetes at bay! 
		<h3>Sign Up Here</h3> 
		Ready to sign up? Go <a href="signup.php">here</a> to sign up today.
	</div>
	</div>
	<script type="text/javascript" src="jquery/jquery.js"></script>
	<script type='text/javascript' src="dropzone.js"></script>
	<script type="text/javascript" src="scripts.js"></script>
</body>
</html>
