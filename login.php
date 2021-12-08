<?php
	session_start();
	// Check if authenticated session exists
	if (isset($_SESSION["authenticatedUser"])) {
		$_SESSION["message"] = "You are logged in as ". $_SESSION['authenticatedUser'];
	}
?>
<head>
<title>Login</title>
	<!-- Apply CSS -->
	<link rel="stylesheet" href="myCSS.css">
</head>
<body>
	<div class="row">
		<?php include_once("header.php"); ?>
		<h2>Login</h2>
		<?php echo "<h3><font color=red>".$_SESSION['message'] . "</font></h3>";
		$_SESSION['message'] = "";
		?>

		<?php if (isset($_SESSION["authenticatedUser"])) { ?>
		<form method="post" action="loginAction.php">
			<input type="hidden" name="signout" value="True" >
			<input name="submit" type="submit" value="Log Out">
		</form>
		<?php } else { ?>
        For Admin user, please use "abdullah/abdullah", and for Normal user, please use "user/user"
		<table width="76%" border="0">
			<tr>
				<td>
					<form method="post" action="loginAction.php">
						<table>
							<tr>
								<td>Username</td>
								<td><input type="text" name="username"></td>
							</tr>
							<tr>
								<td>Password:</td>
								<td><input type="password" name="password"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><p><input name="submit" type="submit" value="Log in"></td>
							</tr>
						</table>
					</form>
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<?php } ?>
		<p>&nbsp;</p>
	</div>
</body>
</html>