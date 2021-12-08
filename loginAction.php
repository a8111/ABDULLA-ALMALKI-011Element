<?php
	session_start();
	include_once ("DB.php");
    
	if (isset($_POST["signout"])) {
        //Delete session and create new instance
		session_destroy();
		session_start();
		$_SESSION["message"] = "Logged out";
		header("Location: login.php");//Page forwarding
	}else {
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);

		if (empty($username) or empty($password)) {
			$_SESSION["message"] = "Must enter Username and Password";
			header("Location: login.php");
			exit;
		}
		
		$query = "SELECT * FROM users WHERE username = '$username' and password='$password'";
		$result = mysqli_query($connection,$query) or exit("Error in query: $query. " . mysqli_error());

		if ($row = mysqli_fetch_assoc($result) ) {

			//Successful login - Create session variable
			$_SESSION["authenticatedUser"] = $row['firstName'];
            $_SESSION['userID'] = $row['userID'];//This could be used later to get more information
            $_SESSION['isAdmin'] = $row['isAdmin'];//This could be used later to get more information

			header("Location: login.php");
		} else {//Unsuccesful login
			session_destroy();
			session_start();
			$_SESSION["message"] = "Could not login as $username";
			header("Location: login.php");
		}
	}
?>