<?php
	session_start();
	$_SESSION["message"] = "";
?>
<html lang="en">
	<head>

		<title>Manage Flights</title>
		<!-- List of all flights of ordering by origin, destination or flight  -->

		<!-- Application custom CSS -->
		<link rel="stylesheet" href="myCSS.css">

	</head>
	<body>
		<?php include_once("header.php"); ?>

		<div>
		<h1> Flights </h1>

		<?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
			<div>
				<a href="AddEditFlight.php">Add New Flight</a><br/>
			</div>
		<?php } else { ?>
			<form method="post" action="manageFlights.php">
				Origin: <input type="text" id="origin" name="origin">
                Destination: <input type="text" id="destination" name="destination">
                Airlines: <input type="text" id="airlines" name="airlines">
				<input type="submit" value="Search">
			</form>
		<?php } ?>
		<br/>

		<table border=1>
				<tr>
					<th>ID</th>
					<th><a href="manageFlights.php?o=orgAsc"><img src="images/up.png"/></a>Origin&nbsp;&nbsp;<a href="manageFlights.php?o=orgDesc"><img src="images/down.png"/></a></th>
					<th><a href="manageFlights.php?o=destAsc"><img src="images/up.png"/></a>Destination&nbsp;&nbsp;<a href="manageFlights.php?o=destDesc"><img src="images/down.png"/></a></th>
					<th><a href="manageFlights.php?o=airAsc"><img src="images/up.png"/></a>Airlines&nbsp;&nbsp;&nbsp;<a href="manageFlights.php?o=airDesc"><img src="images/down.png"/></a></th>
					<?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?> <th>Edit</th><th>Delete</th> <?php } ?>
				</tr>

				<?php
					$_SESSION["message"] = "";
					include_once("DB.php");
					$query = "SELECT * FROM flight where 1=1 ";


					if (isset($_POST["origin"])){
						$origin = $_POST['origin'];
						if($origin != "") { $query = $query . " and origin like '%$origin%'"; }
					}

					if (isset($_POST["destination"])){
						$destination = $_POST['destination'];
						if($destination != "") { $query = $query . " and destination like '%$destination%'"; }
					}
                    
                    if (isset($_POST["airlines"])){
						$airlines = $_POST['airlines'];
						if($airlines != "") { $query = $query . " and company like '%$airlines%'"; }
					}


					//Adding the order to the query depending on the value of the o parameter sent in the URL.
					if (isset($_GET["o"])) {
						$orderby = $_GET["o"];
						switch ($orderby) {
							case "destAsc": $query = $query . " ORDER BY destination ASC "; break;
							case "destDesc": $query = $query . " ORDER BY destination DESC "; break;
							case "orgAsc": $query = $query . " ORDER BY origin ASC "; break;
							case "orgDesc": $query = $query . " ORDER BY origin DESC "; break;
							case "airAsc": $query = $query . " ORDER BY company ASC "; break;
							case "airDesc": $query = $query . " ORDER BY company DESC "; break;
						}
					}

					$result = mysqli_query($connection, $query)  or exit ("Error in query: $query. ".mysqli_error());

					while ($row = mysqli_fetch_assoc($result))    {
				?>
					<tr>
						<!-- Using a hyperlink to go from the list to the Editing page  -->
						<td style='width:100px'> <?php echo "<a href='AddEditFlight.php?flightID=" . $row['id'] . "'> " . $row['id'] . " </a>"; ?>  </td>
						<td style='width:100px'> <?php echo $row['origin']; ?> </td>
						<td style='width:100px'> <?php echo $row['destination']; ?> </td>
						<td style='width:100px'> <?php echo $row['company']; ?> </td>
						<!-- Open AddEditFlight with the parameter delete=true to delete a flight -->
						<?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
							<td style='width:100px;text-align:center'> <?php echo "<a href='AddEditFlight.php?flightID=" . $row['id'] . "'> <img src='images/edit.gif'/> </a>"; ?> </td>
                            <td style='width:100px;text-align:center'> <?php echo "<a href='AddEditFlightAction.php?flightID=" . $row['id'] . "&delete=true'> <img src='images/delete.png'/> </a>"; ?> </td>
						<?php } ?>
					</tr>
				<?php } ?>
			</table>
		</div>



	</body>
</html>