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
							<input type="submit" name="login" value="Login">
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
			<p id="logRegResult"></p>
		</div>
	</body>
</html>

<?php
	$username = "root";
	$password = "";
	$database = "zavoky";
	$server = "localhost";

	try {
		$connection = new PDO('mysql:host=localhost;dbname=zavoky', $username, $password);
		$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo "Error: ", $e->getMessage(), "<br/>";
		die();
	}

	// check if fields are empty
	if (isset($_POST['register'])) {
		$user = $_POST['usernameReg'];
		$pass = $_POST['passwordReg'];
		
		// prepared statement to prevent SQL injection
		// check if username is taken
		$dupeCheckSQL = $connection->prepare("SELECT * FROM users WHERE username = :user;");
		$dupeCheckSQL->execute(array('user' => $user));
		
		if ($dupeCheckSQL->rowcount() > 0) {
			echo "<script> logRegResult('dupe'); </script>";
			die();
		}

		// insert data into table
		$registerSQL = $connection->prepare("INSERT INTO users (uuid, username, password) VALUES (uuid(), :user, :pass);");
		$registerSQL->execute(array('user' => $user, 'pass' => $pass));
		echo "<script> logRegResult('regSuccess'); </script>";
	}
	else if (isset($_POST['login'])) {
		$user = $_POST['usernameLogin'];
		$pass = $_POST['passwordLogin'];
		
		// check if entered data is correct
		$LoginCheckSQL = $connection->prepare("SELECT * FROM users WHERE username = :user AND BINARY password = :pass");
		$LoginCheckSQL->execute(array('user' => $user, 'pass' => $pass));
		
		if ($LoginCheckSQL->rowcount() == 1) {
			$cookieValue = $user;
			setcookie("loggedIn", $cookieValue, time()+3600, "/");
			header("Location: /");
		}
		else {
			echo "<script> logRegResult('logFail'); </script>";
		}
	}
?>