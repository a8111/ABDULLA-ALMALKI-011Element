<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<div class="menu_simple" id="nav1">
	<ul>

	<!-- Admin Menu -->
	<?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
		<li>
			<a href="index.php">Home</a>
		</li>
		<li>
			<a href="manageFlights.php">Manage Flights</a>
		</li>
        <li>
			<a href="AddEditFlight.php">Add New Flight</a>
		</li>
		<li>
			<a href='login.php'>Logout</a>
		</li>
	<!-- General All Visitors Menu -->
	<?php } else { ?>
		<li>
			<a href="index.php">Home</a>
		</li>
		<!-- Authenticated User Menu -->
		<?php if (isset($_SESSION["authenticatedUser"])) { ?>
			<li>
                <a href="manageFlights.php">Flights</a>
            </li>
            <li>
				<a href='login.php'>Logout</a>
			</li>
		<?php } else { ?>
			<li>
				<a href='login.php'>Login</a>
			</li>
			<li>
				<a href='signup.php'>Signup</a>
			</li>
		<?php } ?>
	<?php } ?>
	</ul>
</div>