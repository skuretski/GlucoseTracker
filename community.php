<?php
ini_set('session.save_path', '../sessions');
//error_reporting(E_ALL);
//ini_set("display_errors", true);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="CSS/style.css"/>
	<link rel="stylesheet" type="text/css" href="CSS/dropzone.css"/>
	<title>Our Community</title>
</head>
<body>
	<h1>Our Community</h1>
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
		<div id="whatIsComm">
			<h2>We stick together!</h2>
			All of us at Glucose Keeper enjoy sharing inspiring stories, tips, and tricks to maintain healthy blood sugars. We love our close knit community of supporters, cheerleaders, and enthusiasts to keep us on target and motivated! 
		</div>
		<div id="sharing">
			<h2>Share your carb friendly foods here!</h2>
			Did you cook something up that was delicious <em>AND</em> had a low carbohydrate content? 
			Share your photos and recipes here! We love to see creativity and yumminess together. Please note only registered users can share photos, but feel free to browse our gallery!
		</div>
	</div>
	<div id="wrapper">
		<h2>Our Gallery</h2>
		<div id="photos">
		</div>
		<h2>Add Photos Here!</h2>
		<div id="photoUpload">
			<form action="upload.php" id="mydrop" class="dropzone"></form>
		</div>
		<span id="photosMessage"></span>
	</div>
	<div id="wrapper">
		<h2>Share Recipes</h2>
		Have a recipe to share? Let others partake in your delicious findings.
		<div id="add_recipe">
			<form id="addRecipe">
				<label>Recipe Name</label>
				<input type="text" id="recipeName"><br><br>
				<textarea id="recipeText"></textarea>
				<input type="submit" value="Add Recipe">
			</form>
			<span id="recipeMessage"></span>
		</div> 
		<hr>
		<h2>Here are some of our community's recipes!</h2>
		<div id="recipes">	
		</div>
	</div>
	<script type='text/javascript' src='jquery/jquery.js'></script>
	<script type='text/javascript' src='dropzone.js'></script>
	<script type='text/javascript' src='scripts.js'></script>	
</body>
</html>

