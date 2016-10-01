<!DOCTYPE html>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
		<script type="text/javascript" src="script.js"></script>
		<title>Home - Zavoky</title>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<a id="logReg" href="./login">Login / Register </a>
				<div id="welcomeWrapper">
					<span id="welcome"></span>
					<span><?=$_COOKIE["loggedIn"];?></span>
				</div>
				<div id="backgroundselect">
					<button id="background1" onclick="bgselect('white');"></button>
					<button id="background2" onclick="bgselect('greenCup');"></button>
					<button id="background3" onclick="bgselect('stressedLinen');"></button>
				</div>
				<div id="directory">
					<h1>Directory</h1>
						<a class="directorylinks" href="javascript:;" onclick="reveal('manatee');">manatee</a>
						<a class="directorylinks" href="javascript:;" onclick="reveal('calc');">calc</a>
				</div>
			</div>
			
			<div class="directlist" id="manatee">
				<video controls>
					<source src="./images/manatee.mp4" type="video/mp4">
					Browser doesn't support this video type, rip
				</video>
			</div>
			
			<div class="directlist" id="calc">
				<table>
					<tr>
						<td><input type="text" id="calcInput1" size="5"></td>
						<td><input type="text" id="calcInput2" size="5"></td>
						<td><button id="calcButton" onclick="calc()">Add</button></td>
					</tr>
				</table>
				<p id="calcResult"></p>
			</div>
		</div>
	</body>
</html>

<?php
	if (isset($_COOKIE["loggedIn"])) {
		$cookieValue = $_COOKIE["loggedIn"];
		echo "<script>
				document.getElementById('welcome').innerHTML = 'Welcome '
				document.getElementById('logReg').innerHTML = 'Logout';
				document.getElementById('logReg').href = './logout';
			</script>";
	}
?>