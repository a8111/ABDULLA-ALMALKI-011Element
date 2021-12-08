<!doctype html>
<?php
	session_start();
	$_SESSION["message"] = "";
?>
<html lang="en">
	<head>
		<title>My Flights</title>
		<link rel="stylesheet" href="myCSS.css">		<!-- Application custom CSS -->
	</head>
	<body>
		<?php include_once("header.php"); ?>
        <div class="row">
        	<h1>Welcome to my Flights website</h1>
        	<p>Enjoy your visit!</p>
            <img src = 'images\homepageBanner.jpg'/>
		<br/>

		<?php include_once("footer.php"); ?>

	</body>
</html>