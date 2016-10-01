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
	$password = "Perry1m2";
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
	echo "<script>console.log('lmao')</script>;";
		$user = $_POST['usernameReg'];
		$pass = $_POST['passwordReg'];
		$date = date('Y-m-d H:i:s');
		$passHash = password_hash($pass, PASSWORD_DEFAULT);
		
		// prepared statement to prevent SQL injection
		// check if username is taken
		$dupeCheckSQL = $connection->prepare("SELECT * FROM users WHERE username = :user;");
		$dupeCheckSQL->execute(array('user' => $user));
		
		if ($dupeCheckSQL->rowcount() > 0) {
			echo "<script> logRegResult('dupe'); </script>";
			die();
		}

		// insert data into table
		try {
			$registerSQL = $connection->prepare("INSERT INTO users (uuid, username, password, datetime) VALUES (uuid(), :user, :passHash, :date);");
			$registerSQL->execute(array('user' => $user, 'passHash' => $passHash, 'date' => $date));
		} catch (PDOException $e) {
			echo "Error: ", $e->getMessage(), "<br/>";
		}
		echo "<script> logRegResult('regSuccess'); </script>";
	}
	else if (isset($_POST['login'])) {
		$user = $_POST['usernameLogin'];
		$pass = $_POST['passwordLogin'];
		$passHash = password_hash($pass, PASSWORD_DEFAULT);
		
		$LoginCheckSQL = $connection->prepare("SELECT * FROM users WHERE username = :user");
		$LoginCheckSQL->execute(array('user' => $user));

		if ($LoginCheckSQL->rowcount() == 1 
			&& password_verify($pass, $passHash)) {
			$cookieValue = $user;
			setcookie("loggedIn", $cookieValue, time()+3600, "/");
			header("Location: /");
		}
		else {
			echo "<script> logRegResult('logFail'); </script>";
		}
	}
?>