<?php

	function openMySQLDBConnection() {
		/* Include the Database Parameters */
		require "_dbparams.php";

		/* Create Connection */
		$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
		/* check connection */
		if (mysqli_connect_errno()) {
		    echo "
		    <div class=\"row\">
				<div class=\"col-10 hgrid-3\">&nbsp;</div>
			</div>
		    <div class=\"row padtop-4\">
				<div class=\"col-1\"></div>
				<div class=\"col-8 col-header\"><p>Connect Exception Thrown:&nbsp;" . mysqli_connect_error() . "</p></div>
				<div class=\"col-1\"></div>
			</div>
			<div class=\"row\">
				<div class=\"col-10 hgrid-3\">&nbsp;</div>
			</div>";
		    exit();
		}
		return $mysqli;
	}

	function closeMySQLConnection($conn) {
		/* Close MySQL Connection */
		$conn->close();
	}

	/* Get the Database Connection */
	$mysqli = openMySQLDBConnection();
	
	/* Select query to check if email exists already */
	$stmt = $mysqli->prepare("SELECT count(1) FROM newsletter_subscription");
	$stmt->execute();
	$stmt->bind_result($records);
	
	while ($stmt->fetch()) {
		$rc = $records;
	}
	
	/* close statement */
	$stmt->close();

	/* Close MySQL Connection */
	closeMySQLConnection($mysqli);

	echo $rc;
?>