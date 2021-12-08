<!doctype html>
<?php
	session_start();
?>
<html lang="en">
	<head>
		<!-- One single page to Update an Existing Flight or Create a new Flight  -->
		<title>Edit or Create your Flight</title>
		
		<!-- Application custom CSS -->
		<link rel="stylesheet" href="myCSS.css">

	</head>
	<body>
		<?php
			if (isset($_GET['flightID']))
				$flightID = $_GET["flightID"];
			else
				$flightID = "0";

			//Start with empty variables. These will be used in case of the creation of a new flights
			$origin = "";
			$destination = "";
			$company = "";
			include_once("header.php");
			include_once("DB.php");

			//Get the information for the requested chosen flight
			$query = "SELECT * FROM Flight where ID = " . $flightID;
			$result = mysqli_query($connection, $query)  or exit ("Error in query: $query. ".mysqli_error());
		?>
        <div class="row">
        	<h1>Add/Edit Flight</h1>

        	<div id="errorMessage">
        		<?php echo "<h3><font color=red>".$_SESSION['message']."</font></h3>";
        		$_SESSION["message"] = ""; ?>
        	</div>
		<form method="post" action="AddEditFlightAction.php" enctype="multipart/form-data">
			<input type="hidden" name="flightID" id="flightID" value="<?php echo $flightID ?>"/>
		   <?php
		   //If we are updating an existing phone, fill in the values for that specific phone
			while ($row = mysqli_fetch_assoc($result))    {
				$flightID = $row['id'];
				$origin = $row['origin'];
				$destination = $row['destination'];
				$company = $row['company'];
			 } ?>

				<div>
					<ul>
						<li>
							<div> ID </div>
							<input class="narrow text input" id="ID" name="ID" type="text" value="<?php echo $flightID; ?>" disabled />
						</li>
						<li>
							<div> Origin </div>
							<input class="narrow text input" id="origin" name="origin" type="text" value="<?php echo $origin; ?>" />
						</li>
						<li>
							<div> Destination </div>
							<input class="xnarrow text input" id="destination" name="destination" type="text" value="<?php echo $destination; ?>" />
						</li>
						<li>
							<div> Airlines </div>
							<input class="xnarrow text input" id="company" name="company" type="text" value="<?php echo $company; ?>" />
						</li> 
					</ul>
					<div class="medium primary btn">
						<a><input type="Submit" value="Save"/></a>
					</div>
				</div>
			<br/><br/>
		</form>

	</body>
</html>