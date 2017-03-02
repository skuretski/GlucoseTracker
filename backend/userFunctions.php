<?php
ini_set('session.save_path', '../sessions');
include "dbFunctions.php";
//error_reporting(E_ALL);
//ini_set("display_errors", true);


if(isset($_POST["action"])){
	$action = $_POST["action"];
	if($action === "checkSignIn"){
		if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
			echo 'You are signed in ' . $_SESSION["user"] . '.';
			echo '<div id="logout"><a href="index.php?logout=true">Logout</a></div>';
		}
	}
}
if(isset($_GET["action"]) && $_GET["action"] === "addRecipe"){
	if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
		echo "A registered user may only enter recipes.<br>";
	}
	else{
		if(empty($_GET["recipe"]) || empty($_GET["recipeName"])){
			echo "Please enter text in the field(s).";
		}else{
			addRecipes($_SESSION["user"], $_GET["recipe"], $_GET["recipeName"]);
		}	
	}
}

if(isset($_GET["action"]) && $_GET["action"] === "getRecipes"){
	getRecipes();
}

if(isset($_GET["action"]) && $_GET["action"] === "filter"){
	$action = $_GET["action"];
	if($action === "filter" && isset($_SESSION["user"])){
		$days = $_GET["days"];
		date_default_timezone_get();
		$date = date('Y-m-d H:i:s', time());
		$end = $date;
		$start = date('Y-m-d H:i:s', strtotime('- ' .strval($days). 'days'));
		filter($start, $end, $_SESSION["user"]);
	}
}

if(isset($_POST["newUsername"]) && isset($_POST["newEmail"]) && isset($_POST["newPassword"]) 
	&& isset($_POST["newPassword2"])){
	$username = $_POST["newUsername"];
	$email = $_POST["newEmail"];
	$password = $_POST["newPassword"]; 
	if((!empty($_POST["newPassword"]) && !empty($_POST["newPassword2"])) && 
		$_POST["newPassword"] === $_POST["newPassword2"])
		$password = $_POST["newPassword"];
	else
		echo "Error the passwords did not match or are empty.<br>";
	if(!empty($username)){
		checkUsername($username);
		if($error === true){
			echo "Username already exists.<br>";
		}
	}
	if(!empty($email)){
		checkEmail($email);
		if($error === true){
			echo "Email already used.<br>";
		}
	}
	if($error === false){
		addUser($username, $password, $email);
		$_SESSION["user"] = $_POST["newUsername"];
		$_SESSION["verified"] = true;
		$string = '<html><script type="text/javascript">';
		$string .= 'window.location.href = "https://web.engr.oregonstate.edu/~kuretsks/cs290/Final/yourGlucose.php"';
		$string .= '</script></html>';
		echo $string; 
	}
	else if($error === true){
		echo "An error occurred with new user creation.<br>";
	}
}

if(isset($_REQUEST['action']) && isset($_SESSION['user'])){
	$action = $_REQUEST['action'];
	if($action === 'showAll'){
		getAll($_SESSION['user']);
	}
}
if(isset($_REQUEST['action']) && isset($_SESSION['user']) && isset($_REQUEST['glucose'])){
	$action = $_REQUEST['action'];
	if($_REQUEST['date'] === '' || empty($_REQUEST['date'])){
		date_default_timezone_get();
		$date = date('Y-m-d H:i:s', time());
	}else{
		$date = date("Y-m-d H:i:s", strtotime($_REQUEST['date']));
	}
	$sugar = $_REQUEST['glucose'];
	$units = $_REQUEST['units'];
	$type = $_REQUEST['type'];
	if($action === 'add'){
		addGlucose($_SESSION['user'], $date, $sugar, $units, $type);
	}
}
if(isset($_REQUEST['action']) && isset($_SESSION['user']) && isset($_REQUEST['id'])){
	$action = $_REQUEST['action'];
	$id = $_REQUEST['id'];
	if($action === 'delete'){
		deleteGlucose($_SESSION['user'], $id);
	}
}
if(isset($_REQUEST['action'])){
	$action = $_REQUEST['action'];
	if($action === 'showPhotos'){
		foreach(glob('uploads/*.jpg') as $filename){
			chmod($filename, 0755);
			echo '<img src="' . $filename . '" height=175 width=280/>';
		}
		foreach(glob('uploads/*.png') as $filename){
			chmod($filename, 0755);
			echo '<img src="' . $filename . '"height=175 width=280/>';
		}
		foreach(glob('uploads/*.gif') as $filename){
			chmod($filename, 0755);
			echo '<img src="' . $filename . '"height=175 width=280/>';
		}
	}
}

?>