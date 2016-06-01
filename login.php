<html>
	<head>
		<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
		<script type="text/javascript" src="script.js"></script>
		<title>Login - Zavoky</title>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="directory">
					<h1>Login / Register</h1>
				</div>
				<div id="backgroundselect">
					<button id="background1" onclick="bgselect('white');"></button>
					<button id="background2" onclick="bgselect('greenCup');"></button>
					<button id="background3" onclick="bgselect('stressedLinen');"></button>
				</div>
			</div>
			<div id="loginRegWrapper">
				<div id="loginCSS">
					<form method="post" action="login.php">
						<fieldset>
							<legend>Login</legend>
							Username: <input type="text" name="usernameLogin" size=16><br><br>
							Password: <input type="password" name="passwordLogin" size=16><br><br>
							<input type="submit" value="Login">
						</fieldset>
					</form>
				</div>
				<div id="regCSS">
					<form method="post" name="regForm">
						<fieldset>
							<legend>Register</legend>
							Username: <input type="text" name="usernameReg" size=16><br><br>
							Password: <input type="password" name="passwordReg" size=16><br><br>
							<input type="submit" value="Register">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	$username = "nathan";
	$password = "Perry1m2";
	$datebase = "zavoky";
	$server = "zavoky.com:80";
	
	$link = mysql_connect("$server", "$username", "$password");
	if (!$link){
		die('Could not connect: ' . mysql_error());
	}

	echo 
		
	mysql_select_db("$database");
	
	$username = $_POST["usernameReg"];
	$password = $_POST["passwordReg"];
	
	$order = "INSERT INTO users
			(username, password)
			VALUES
			('$username',
			'$password')";
	
	$result = mysql_query($order);
	
	if($result){
		echo("<br>Input data is successful");
	} else{
		echo("<br>Input data is fail");
	}
?>