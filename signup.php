<?php
ini_set('session.save_path', '../sessions');
//error_reporting(E_ALL);
//ini_set("display_errors", true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="CSS/style.css"/>
	<title>Sign Up</title>
</head>
<body>
	<h1>Sign Up Here!</h1>
	<nav>
		<ul>
			<li><a href = "index.php">Home</a></li>
			<li><a href = "yourGlucose.php">Your Glucose Log</a></li>
			<li><a href = "community.php">Our Community</a></li>
			<li><a href = "signup.php">Sign Up</a></li>
		</ul>
	</nav>
	<div id="userIn">
	</div>
	<div id="wrapper">
	<div id="userIn">
	</div><br>
	<div id="signupWelcome">Sign up here for your free glucose log! We'll keep 
		track of everything. All you need to do is sign up and start today.<br/>  
	</div>
	<div id="wrapper">
	<div>
		<form id='signup'>
			<label>Username:</label>
				<input type="text" name="newUsername" id="newUsername" required/>
				<span id="username_message"></span><br/>
			<label>Email:</label>
				<input type="email" name="newEmail" id="newEmail" required/>
				<span id="email_message"></span><br/>
			<label>Password:</label>	
				<input type="password" name="newPassword" id="newPassword" required/><br/>
			<label>Re-enter Password:</label>
				<input type="password" name="newPassword2" id="newPassword2" required/>
				<span id="password_message"></span><br/>
			<input type="submit" value="Submit"><br/>
				<span id="creation_message"></span><br/>
		</form>
	</div>
	</div>
	</div>
	<script type='text/javascript' src='jquery/jquery.js'></script>
	<script type='text/javascript' src="dropzone.js"></script>
	<script type='text/javascript' src='scripts.js'></script>
</body>
</html>