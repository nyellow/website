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
					<form method="post">
						<fieldset>
							<legend>Login</legend>
							Username: <input type="text" name="usernameLogin" size=16><br><br>
							Password: <input type="password" name="passwordLogin" size=16><br><br>
							<input type="submit" value="Login">
						</fieldset>
					</form>
				</div>
				<div id="regCSS">
					<form method="post">
						<fieldset>
							<legend>Register</legend>
							Username: <input type="text" name="usernameReg" size=16><br><br>
							Password: <input type="password" name="passwordReg" size=16><br><br>
							<input type="submit" name="register" value="Register">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	$username = "root";
	$password = "";
	$database = "zavoky";
	$server = "localhost";
	
	$link = mysqli_connect($server, $username, $password, $database);
	
	if (!$link){
		die('Could not connect');
	}

	if (isset($_POST['register'])) {
		
		$user = $_POST['usernameReg'];
		$pass = $_POST['passwordReg'];
		$order = "INSERT INTO users (username, password) VALUES ('$user', '$pass');";
		$result = mysqli_query($link, $order);
		}
?>