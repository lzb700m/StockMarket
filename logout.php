<?php
	session_start();
	require_once("includes/config.php");

	if (!isset($_SESSION['user'])) {
	    header("Location: index.php");
	} else if (isset($_SESSION['user']) != "") {
	    header("Location: index.php");
	}

	if (isset($_GET['logout'])) {
	    session_destroy();
	    unset($_SESSION['user']);
	    header("Location: index.php");
	}

	require_once(TEMPLATES_PATH . "includes/footer.php");
?>