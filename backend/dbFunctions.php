<?php
require "hidden_server_info.php";
ini_set('session.save_path', '../sessions');
//error_reporting(E_ALL);
//ini_set("display_errors", true);
session_start();

//Globals
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", $myUsername, $myPassword, $myUsername);
if($mysqli->connect_errno){
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$glucose = 'glucose';
$users = 'users';
$recipes = 'recipes';
$error = false;

//Get all user's glucose data
function getAll($username){
	global $mysqli, $glucose;
	$all = $mysqli->prepare("SELECT id, date, glucose, insulin_units, insulin_type FROM $glucose WHERE username = ?");
	$all->bind_param("s", $username);
	$all->execute();
	$results = $all->get_result();
	showResults($results);
	$all->close();
}

//Show results
function showResults($results){
	echo "<table><tr>";
	echo "<th>Date</th><th>Glucose</th><th>Insulin Units</th><th>Insulin 
	Type</th><th>Delete</th></tr><tbody id='table'>";
	while($row = $results->fetch_assoc()){
		$date = date_create($row["date"]);
		echo "<tr id=".$row["id"] ."><td>" . date_format($date, 'm/d/Y g:ia') . "</td>";
		echo "<td>" . $row["glucose"] . "</td>";
		echo "<td>" . $row["insulin_units"] . "</td>";
		echo "<td>" . $row["insulin_type"] . "</td>";
		echo "<td><button class='delete'>Delete</button></td></tr>";
	}
	echo "</tbody></table><br/>";
}

function filter($start, $end, $username){
	global $mysqli, $glucose;
	$filter = $mysqli->prepare("SELECT id, date, glucose, insulin_units, insulin_type FROM $glucose 
		WHERE date between ? and ? and username = ?");
	$filter->bind_param("sss", $start, $end, $username);
	$filter->execute();
	$results = $filter->get_result();
	showResults($results);
	$filter->close();
}
function verifyUser($password, $username){
	global $mysqli, $users, $error, $trueMatch;
	$trueMatch = false;
	$falseMatch = false;
	$userData = $mysqli->prepare("SELECT * FROM $users WHERE username = ?");
	$userData->bind_param("s", $username);
	$userData->execute();
	$results = $userData->get_result();
	while($row = $results->fetch_assoc()){
		if(password_verify($password, $row["password"]))
			$trueMatch = true;
		else
			$falseMatch = true;
	}
	if($trueMatch){
		$_SESSION["verified"] = true;
		$error = false;
	}
	else{
		$_SESSION["verified"] = false;
		$error = true;
	}
	$userData->close();	
}

function checkUsername($username){
	global $mysqli, $users, $error;
	$username_query = $mysqli->prepare("SELECT * FROM $users
		WHERE username = ?");
	$username_query->bind_param("s", $username);
	$username_query->execute();
	$result = $username_query->get_result();
	$count = $result->num_rows;
	if($count === 1){
		$error = true;
	}
	$username_query->close();
}

function checkEmail($email){
	global $mysqli, $users, $error;
	$useremail_query = $mysqli->prepare("SELECT * FROM $users
		WHERE email = ?");
	$useremail_query->bind_param("s", $email);
	$useremail_query->execute();
	$result = $useremail_query->get_result();
	$count = $result->num_rows;
	if($count === 1){
		$error = true;
	}
	$useremail_query->close();
}

function addUser($username, $password, $email){
	global $mysqli, $users;
	$hashPW = password_hash($password, PASSWORD_DEFAULT);
	$insertUser = $mysqli->prepare("INSERT into $users(username,password,email)values(?,?,?)");
	$insertUser->bind_param("sss", $username, $hashPW, $email);
	$insertUser->execute();
	$insertUser->close();
}

function addGlucose($username, $date, $sugar, $units, $type){
	global $mysqli, $glucose;
	$insertGlucose = $mysqli->prepare("INSERT into $glucose(username, date, glucose,insulin_units,insulin_type)
		values(?,?,?,?,?)");
	$insertGlucose->bind_param("ssiis",$username, $date, $sugar,$units,$type);
	$insertGlucose->execute();
	$insertGlucose->close();
}

function deleteGlucose($username, $id){
	global $mysqli, $glucose;
	$deleteGlucose = $mysqli->prepare("DELETE from $glucose WHERE id=? AND username =?");
	$deleteGlucose->bind_param("is", $id, $username);
	$deleteGlucose->execute();
	$deleteGlucose->close();
}

function addRecipes($username, $recipe, $recipeName){
	global $mysqli, $recipes;
	$addRecipe = $mysqli->prepare("INSERT into $recipes(username, recipe, recipe_name)values(?,?,?)");
	$addRecipe->bind_param("sss", $username, $recipe, $recipeName);
	$addRecipe->execute();
	$addRecipe->close();
}

function getRecipes(){
	global $mysqli, $recipes;
	$getRecipes = $mysqli->prepare("SELECT * from $recipes");
	$getRecipes->execute();
	$results = $getRecipes->get_result();
	printRecipes($results);
	$getRecipes->close();
}

function printRecipes($results){
	while($row = $results->fetch_assoc()){
		echo "<p>";
		echo "<em><font color='red'>". $row["username"] . "</font></em> added: <br><br>";
		echo "<em>" .$row["recipe_name"] ."</em><br><br>" . $row["recipe"] . "<hr>";
		echo "</p>";
	}
}

?>