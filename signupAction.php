<?php
	session_start();
	include_once ("DB.php");

	$username    =     	$_POST['username'];
	$password    =      $_POST['password'];
	$firstName   =    	$_POST['firstName'];
	$lastName    =     	$_POST['lastName'];
	$email       =		$_POST['email'];

	//Make sure that all fields have values and are not empty
	if (empty($username) or empty($password) or empty($firstName) or empty($lastName) or empty($email) ) {
		$_SESSION["message"] = "All fields on this page are required";
		header("Location: signup.php");	//If not, redirect to homepage
		exit ;//Ends the script
	}

	//Query to check if username exists
	$query = "SELECT * FROM users WHERE username = '$username' ";
	$result = mysqli_query($connection,$query) or exit("Error in query: $query. " . mysqli_error());

	if ($row = mysqli_fetch_assoc($result)) {
		//if row returned, the username already exists - send back to signup page
		$_SESSION["message"] = " '$username' already exists. Please choose a different username";
		header("Location: signup.php");
		exit ;//Ends the script
	}

	//Query to check if email exists
	$query = "SELECT * FROM users WHERE email = '$email' ";
	$result = mysqli_query($connection,$query) or exit("Error in query: $query. " . mysqli_error());

	//See if any rows were returned to check that the email chosen does not exist for another user.
	if ($row = mysqli_fetch_assoc($result)) {
		//Then we have a successful login
		//Create a session variable to store the user name.
		$_SESSION["message"] = " '$email' already exists. Please choose a different email";
		header("Location: signup.php");	//Redirection information
		exit ;//Ends the script
	}

	//If unique username and email then insert user using INSERT query
	$query = "INSERT INTO users( username,password,firstName,lastName,email,isAdmin) VALUES('$username', '$password', '$firstName', '$lastName', '$email' , 0)";
	$result = mysqli_query($connection, $query);

	//if there was a problem - get the error message and go back
	if (mysqli_affected_rows($connection) < 0) {
		$_SESSION["message"] =  "There were errors :" . mysql_error();
	} else{
		if($userID!=""){
			$_SESSION["message"] =  "User updated successfully";
		}else{
			$_SESSION["message"] =  "User created";
		}
	}
	echo $_SESSION["message"];
	echo "isAdmin:" . $isAdmin;
	header("Location: signup.php");//Go back to the Manage Users pages
?>