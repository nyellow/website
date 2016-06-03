<?php
	setcookie("loggedIn", "val", time()-3600, "/");
	header("Location: /");
?>