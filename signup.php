<!doctype html>
<?php
	session_start();
?>
<html lang="en">
	<head>
		<title>Signup</title>
		<link rel="stylesheet" href="myCSS.css">
	</head>
	<body>
		<?php include_once("header.php"); ?>
        <div class="row">
        	<h1>Complete your profile</h1>

        	<div id="errorMessage">
        		<?php echo "<h3><font color=red>".$_SESSION['message']."</font></h3>";
        		$_SESSION["message"] = ""; ?>
        	</div>

		<form method="post" action="signupAction.php" onsubmit="return validate();">
				<div>
					<ul>
						<li class="field">
							<div> Username </div>
							<input id="username" name="username" type="text"/>
						</li>
						<li class="field">
							<div> Password </div>
							<input id="password" name="password" type="text"/>
						</li>
						<li class="field">
							<div> Firstname </div>
							<input id="firstName" name="firstName" type="text"/>
						</li>
						<li class="field">
							<div> Surname </div>
							<input id="lastName" name="lastName" type="text"/>
						</li>
						<li class="field">
							<div> Email </div>
							<input class="narrow text input" id="email" name="email" type="text"/>
						</li>
					</ul>
					<div>
						<a><input type="Submit" value="Save"/></a>
					</div>
				</div>
			<br/><br/>
		</form>
		<?php include_once("footer.php"); ?>
	</body>
</html>