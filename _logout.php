<?php
	session_start();
	if (session_destroy()) {
		header("Location: home.html"); // Redirecting To Home Page
	}
?>