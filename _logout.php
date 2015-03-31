<?php
	session_start();
	if (session_destroy()) {
		header("Location: home.html"); // Redirecting To Home Page
	}
?>
<!-- Copyright Protected 2015 Boston University, Romit Maity BU MET CS -->