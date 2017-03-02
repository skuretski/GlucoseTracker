<?php 
ini_set('session.save_path', '../sessions');
include "dbFunctions.php";

//error_reporting(E_ALL);
//ini_set("display_errors", true);

if(isset($_POST["newUsername"])){
	$username = $_POST["newUsername"];
	if(!empty($username)){
		global $mysqli, $users;
		$username_query = $mysqli->prepare("SELECT * FROM $users
			WHERE username = ?");
		$username_query->bind_param("s", $username);
		$username_query->execute();
		$result = $username_query->get_result();
		$count = $result->num_rows;
		if($count === 1){
			echo "Username already exists.";
		}
		else if($count === 0){
			echo "Valid username.";
		}
	}
}
if(isset($_POST["newEmail"])){
	$email = $_POST["newEmail"];
	if(!empty($email)){
		global $mysqli, $users;
		$useremail_query = $mysqli->prepare("SELECT * FROM $users
			WHERE email = ?");
		$useremail_query->bind_param("s", $email);
		$useremail_query->execute();
		$result = $useremail_query->get_result();
		$count = $result->num_rows;
		if($count === 1){
			echo "Email already exists.";
		}
		else if($count === 0){
			echo "Valid email.";
		}
	}
}

if(isset($_POST["newPassword"]) && isset($_POST["newPassword2"])){
	if(!empty($_POST["newPassword"]) && !empty($_POST["newPassword2"])){
		if($_POST["newPassword"] !== $_POST["newPassword2"])
			echo "Passwords do not match.";
		else
			echo "Passwords match.";
	}
}

if(isset($_POST["username"]) && isset($_POST["password"])){ 
	if(!empty($_POST["username"]) && !empty($_POST["password"])){
		global $mysqli, $users, $error;
		$username_query = $mysqli->prepare("SELECT * FROM $users
		WHERE username = ?");
		$username_query->bind_param("s", $_POST["username"]);
		$username_query->execute();
		$result = $username_query->get_result();
		$count = $result->num_rows;
		if($count === 1){
			verifyUser($_POST["password"],$_POST["username"]);
			if($_SESSION["verified"] === true){
				$_SESSION["user"] = $_POST["username"];
				$string = '<html><script type="text/javascript">';
				$string .= 'window.location.href = "https://web.engr.oregonstate.edu/~kuretsks/cs290/Final/yourGlucose.php"';
				$string .= '</script></html>';
				echo $string; 
			}else{ 
			echo "Username and password invalid.";
			}
		}else{
			echo "Username and password invalid.";
		}
	}
	if(empty($_POST["username"]) || empty($_POST["password"])){
		echo "Username and password is required.";
	}	
}	
	
?>