$(window).load(function(){
	checkSignIn();
	if(window.location == "https://web.engr.oregonstate.edu/~kuretsks/cs290/Final/yourGlucose.php"){
		getData();
	}
	if(window.location == "https://web.engr.oregonstate.edu/~kuretsks/cs290/Final/community.php")
		showPictures();
		showRecipes();
});

//AJAX call to get user's information 
function getData(){
	$.ajax({
		method: "POST",
		url: 'userFunctions.php',
		data: {action: "showAll"},
		success: function(data){
			$('#results').html(data);
		}
	}).error(function(){
		alert('Error getting user information.');
	});
}
//Delete button AJAX call
$('#results').on("click", "#table tr td button" ,function(){
	var id = this.parentNode.parentNode.id;
	$.ajax({
		method: "GET",
		url: 'userFunctions.php',
		data: {action: "delete", id: id},
		success: function(){
			getData();
		}
	});
});
//AJAX call when a returning user logs in
$('#login').submit(function(event){
	event.preventDefault();
	$.ajax({
		type: "POST",
		url: "validate.php",
		data: {username: $('#username').val(), password: $('#password').val()},
		success: function(data){
			$('#login_message').html(data);
		}
	}).error(function(){
		alert('Error logging in.');
	});
});

//AJAX call for filtering data
$('#filter').submit(function(event){
	event.preventDefault();
	var days = $('[name="filterDays"]:checked').val();
	$.ajax({
		type: "GET",
		url: "userFunctions.php",
		data: {action: "filter",days: days},
		success: function(data){
			$('#results').html(data);
		}
	});
});

//AJAX call for showing photos
function showPictures(){
	$.ajax({
		method: "POST",
		url: "userFunctions.php",
		data: {action: "showPhotos"},
		success: function(data){
			$('#photos').html(data);
		}
	}).error(function(){
		alert('Error getting photo gallery.');
	});
}
//Checks to see if a user session/a user is signed in
function checkSignIn(){
	$.ajax({
		method: "POST",
		url: "userFunctions.php",
		data: {action: "checkSignIn"},
		success: function(data){
			$('#userIn').html(data);
		}
	});
}

//Function to show all recipes
function showRecipes(){
	$.ajax({
		method: "GET",
		url: "userFunctions.php",
		data: {action: "getRecipes"},
		success: function(data){
			$('#recipes').html(data);
		}
	});
}

//Function to add a recipe
$('#addRecipe').submit(function(event){
	event.preventDefault();
	var recipe = $('#recipeText').val();
	var recipeName = $('#recipeName').val();
	if(recipe === '' || recipeName === ''){
		$('#recipeMessage').text('Please enter text in the field(s).');
	}else{
		$.ajax({
			type: "GET",
			url: "userFunctions.php",
			data: {action: "addRecipe", recipe: recipe, recipeName: recipeName},
			success: function(data){
				$('#recipeMessage').html(data);
				showRecipes();
			}
		});
	}
	$('#recipeName').text('');
	$('#recipeText').text('');
});
//Adding a glucose entry AJAX call
$('#log').submit(function(event){
	event.preventDefault();
	var date = $('#datetimepicker').val();
	var glucose = $('#glucose').val();
	var units = $('#units').val();
	var type;
	if($('[name="insulins"]:checked').val() === "other"){
		type = $('#other').val();
	}else{
		type = $('[name="insulins"]:checked').val();
	}
	$.ajax({
		type: "GET",
		url: "userFunctions.php",
		data: {action: "add", date: date, glucose: glucose,
		units: units, type: type},
		success: function(){
			getData();
		}
	});
});
//AJAX call for a new sign up
$('#signup').submit(function(event){
	event.preventDefault();
	var newuser = $('#newUsername').val();
	var password1 = $('#newPassword').val();
	var password2 = $('#newPassword2').val();
	var email = $('#newEmail').val();
	$('#creation_message').text('');
	if(newuser === ''){
		$('#username_message').text('Username required');
	} 
	if(password1 !== password2){
		$('#password_message').text('Passwords do not match.');
	}
	if(password1 === '' || password2 === ''){
		$('#password_message').text('Password is required.');
	}
	if(email === ''){
		$('#email_message').text('Email is required.');
	}
	if(newuser && email && password1 && password2){
		if(password1 === password2){
			$.ajax({
				type: "POST",
				url: "userFunctions.php",
				data: {newUsername: newuser, newEmail:email, newPassword:password1,
					newPassword2: password2},
				success: function(data){
					$('#creation_message').html(data);
				}
			});
		} 
	}
});
//Customizing Dropzone.js on AJAX completion for PHP messages
Dropzone.options.mydrop = {
	init: function(){
		this.on("success", function(file, responseText){
			$('#photosMessage').text(responseText);
			showPictures();
		});
		this.on("complete", function(file){
			this.removeFile(file);
		});
	}
};

//**********************Sign up functions****************************************
//Username validation//
function usernameValidate(username){
	$.ajax({
		type: "POST",
		url: "validate.php",
		data: {newUsername: username},
		success: function(data){
			$('#username_message').text(data);
		}
	});
}

$('#newUsername').focusin(function(){
	var username = $('#newUsername').val();
	if(username === '')
		$('#username_message').text('Enter username');
	else{
		usernameValidate(username);	
	}	
}).blur(function(){
	$('#username_message').text('');
}).keyup(function(){
	var username = $('#newUsername').val();
	usernameValidate(username);
});


//Email Functions//
function email_validate(email){
	$.ajax({
		type:"POST",
		url: "validate.php",
		data: {newEmail:email},
		success: function(data){
			$('#email_message').text(data);
		}	
	});	
}

$('#newEmail').focusin(function(){
	var email = $('#newEmail').val();
	if(email === '')
		$('#email_message').text('Enter email');
	else{
		email_validate(email);	
	}	
}).blur(function(){
	$('#email_message').text('');
}).keyup(function(){
	var email = $('#newEmail').val();
	email_validate(email);
});
//Password Validation Functions//
function password_validate(password, password2){
	$.ajax({
		type: "POST",
		url: "validate.php",
		data: {newPassword: password, newPassword2: password2},
		success: function(data){
			$('#password_message').text(data);
		}
	});
}

$('#newPassword2').focusin(function(){
	var password = $('#newPassword').val();
	var password2 = $('#newPassword2').val();
	if(password === '' || password2 === ''){
		$('#password_message').text('Passowrd(s) must be entered.');
	}else{
		password_validate(password, password2);
	}
}).blur(function(){
	$('#password_message').text('');
}).keyup(function(){
	var password = $('#newPassword').val();
	var password2 = $('#newPassword2').val();
	password_validate(password, password2);
});

