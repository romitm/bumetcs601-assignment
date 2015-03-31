<?php
	// From http://www.formget.com/login-form-in-php/
	session_start(); 	// Starting Session
	$error = ""; 		// Variable To Store Error Message

	function openMySQLDBConnection() {
		/* Include the Database Parameters */
		require "_dbparams.php";
		/* Create Connection */
		$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
		/* check connection */
		if (mysqli_connect_errno()) {
		    echo "
		    <div class=\"row padtop-4\">
				<div class=\"col-1\"></div>
				<div class=\"col-8 col-header\"><p>Connect Exception Thrown:&nbsp;" . mysqli_connect_error() . "</p></div>
				<div class=\"col-1\"></div>
			</div>";
		    exit();
		}
		return $mysqli;
	}

	function closeMySQLConnection($conn) {
		/* Close MySQL Connection */
		$conn->close();
	}

	/* Login Logic if the Form Submission was correct */
	if (isset($_POST["sitelogin"])) {
		if (empty($_POST["siteusername"]) || empty($_POST["sitepassword"])) {
			$error = "Username or Password is invalid";
		} else {
			/* Define $username and $password */
			$username = $_POST["siteusername"];
			$password = $_POST["sitepassword"];
			
			/* To protect MySQL injection for Security purpose */
			$username = stripslashes($username);
			$password = stripslashes($password);

			/* Get Connection */
			$mysqli = openMySQLDBConnection();
			$stmt = $mysqli->prepare("SELECT count(1) FROM site_users WHERE userid = ? AND passwd = ? limit 0, 1");
			$stmt->bind_param("ss", $username, $password);
			$stmt->execute();
			$stmt->bind_result($linecount);

			while ($stmt->fetch()) {
		        if ($linecount == 1) {
					$_SESSION["uservar"] = $username;
					header("location: _admin.php");
		        } else {
		        	$_SESSION["usererror"] = "ERR01";
					$error = "Username or Password is invalid";
					header("location: _login.php");
		        }
		    }

		    /* Close Statement */
			$stmt->close();
			/* Close Connection */
			closeMySQLConnection($mysqli);
		}
	}
?>
<!-- Copyright Protected 2015 Boston University, Romit Maity BU MET CS -->