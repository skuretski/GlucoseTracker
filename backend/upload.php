<?php
ini_set('session.save_path','../sessions');

//error_reporting(E_ALL);
//ini_set("display_errors", true);
session_start();
header('Content-Type: text/plain; charset=utf-8');
//********************************************************************************
//The following code (mostly error handling) is done with credit to "Anonymous" 
//from http://php.net/manual/en/features.file-upload.errors.php
//********************************************************************************
if(!isset($_SESSION['user'])){
	echo "Sorry, you're not logged in or a registered user. Cannot upload photos.";
}
if(isset($_SESSION['user']) && !empty($_FILES)){
	//Error handling
	if(!isset($_FILES['file']['error']) || is_array($_FILES['file']['error'])){
		echo ('Invalid photo parameters.');
	}
	switch($_FILES['file']['error']){
		case UPLOAD_ERR_OK:
			break;
		case UPLOAD_ERR_NO_FILE:
			echo('No file.');
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo('Exceeds filesize limit.');
		default:
			echo('Error uploading.');
	}
	//If greater than max size
	if($_FILES['file']['size'] > 1000000){
		echo ('Exceeds filesize limit.');
	}
	//If not a jpg, png, or gif
	$finfo = new finfo(FILEINFO_MIME_TYPE);
	if(false === $ext = array_search($finfo->file($_FILES['file']['tmp_name']),
		array('jpg'=>'image/jpeg','png'=>'image/png','gif'=>'image/gif'), true)){
			echo ('Invalid file format.');
	}else{
	//If no errors, upload file to path
		if($_FILES['file']['error'] === UPLOAD_ERR_OK){
			$uploaddir = 'uploads';
			$ds = DIRECTORY_SEPARATOR;
			$tempFile = $_FILES['file']['tmp_name'];
			$targetPath = "/nfs/stak/students/k/kuretsks/public_html/cs290/Final/uploads/";
			$targetFile = $targetPath . $_FILES['file']['name'];
			move_uploaded_file($tempFile, $targetFile);
			echo "Upload successful!";
		}
	}	
}

?>