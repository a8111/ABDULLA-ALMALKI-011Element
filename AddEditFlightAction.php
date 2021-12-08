<?php
	session_start();
	include_once ("DB.php");

	//Check if flightID sent by previous form. If not, then new flight.
	if (isset($_POST['flightID']) && $_POST['flightID']!="" && $_POST['flightID']!="0")
		$flightID = trim($_POST['flightID']);
	else
		$flightID = "-";

	if (isset($_GET['delete']) && $_GET['delete'] == "true" && $_GET['flightID'] != ""){
		$query = "delete from flight WHERE ID = " . $_GET['flightID'];
		$result = mysqli_query($connection, $query);
		header("Location: manageFlights.php");
		exit ;
	}

	$id = trim($_POST['id']);
	$origin = trim($_POST['origin']);
	$destination = trim($_POST['destination']);
	$company = trim($_POST['company']);
	$errorString = "";

	//check that all fields are not empty - server side validation
	if (empty($origin) or empty($destination) or empty($company)) {
		$_SESSION["message"] = "Must enter Origin, Destination and Airlines";
		header("Location: AddEditFlight.php");	//Redirect
		exit ;//Ends the script
	}


	//Check if creation of new flight or update of existing flightID
	if($flightID=="-"){
		$query = "INSERT INTO flight(origin, destination, company) VALUES('$origin', '$destination', '$company')";
		$result = mysqli_query($connection, $query);
		echo "result = " . $result;
	}else{
		$query = "UPDATE flight SET origin = '$origin', destination = '$destination', company ='$company' WHERE ID = '$flightID'";
		$result = mysqli_query($connection, $query);
	}
	echo  '</br>' . $query . '</br>';
	

	//Check for errors
	if (mysqli_affected_rows($connection) < 0) {
		$_SESSION["message"] =  "Error :" . mysql_error() . $query;
	} else{
		if($flightID!=""){
			$_SESSION["message"] =  "Flight updated";
		}else{
			$_SESSION["message"] =  "Flight created";
		}
	}
	echo $_SESSION["message"];
	header("Location: manageFlights.php");//Go back to the Manage flight page
?>