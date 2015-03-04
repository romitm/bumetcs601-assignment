<?php
	session_start();
	if (empty($_SESSION["uservar"])) {
		header("location: _login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin | Newsletter</title>
<!-- Main Stylesheet -->
<link rel="stylesheet" type="text/css" href="styles/submain.css">
<!-- Learning to add Google Font on the page -->
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<meta name="description" content="Boston University">
<meta name="keywords" content="BU, CS601, Web Application Development, Spring, 2015">
<!-- Learning to add a favicon -->
<link rel="icon" href="images/favicon.ico?v=2" type="image/x-icon" />
<meta charset="UTF-8">
</head>
<body>
<header>
	<div class="grid-container hgrid-5 bgblack">
		<div class="row padtop-2 bgblack">
			<div class="col-8 bgblack">
				<div class="header"><p>Subscription Data <span class="mandatory">(Admin Operations)</span></p></div>
			</div>
			<div class="col-2 bgblack">
				<p><img src="images/logo.png" alt="Site Logo" width="200" /></p>
			</div>
		</div>
		<div id="navbar" class="row bgblue">
			<div class="col-10 menu-col-grad">
				<div class="t-right menu-padding menu-item">
					<nav>
						<ul>
							<li><a class="menu-link" href="_logout.php">Logout</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</header>
<section>
	<div class="grid-container">
		<div class="row">
			<div class="col-10 hgrid-3">&nbsp;</div>
		</div>
<?php
	/*
	$mysql_host = "mysql3.000webhost.com";
	$mysql_database = "a3640742_bumetcs";
	$mysql_user = "a3640742_admin";
	$mysql_password = "password1";
	*/
	$mysql_host = "localhost";
	$mysql_user = "root";
	$mysql_database = "bumetcs";
	$mysql_password = "password";

	// Create Connection
	$conn = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);

	// Check Connection
	if ($conn->connect_error) {
		die("<h4>Connection Failed: </h4>" . $conn->connect_error . "<br/>");
	}
	echo "
	<div class=\"row padtop-2\">
		<div class=\"col-1\"></div>
		<div class=\"col-8 sub-col-grad\">
			<div><h3>Displaying All Newsletter Subscribers</h3></div>
		</div>
		<div class=\"col-1\"></div>
	</div>";

	echo "
	<div class=\"row padtop-1\">
		<div class=\"col-1\"></div>
		<div class=\"col-1 col-header\"><p>DB #ID</p></div>
		<div class=\"col-1 col-header\"><p>First Name</p></div>
		<div class=\"col-1 col-header\"><p>Last Name</p></div>
		<div class=\"col-1 col-header\"><p>Email</p></div>
		<div class=\"col-1 col-header\"><p>Active</p></div>
		<div class=\"col-1 col-header\"><p>Birth Day</p></div>
		<div class=\"col-1 col-header\"><p>Birth Month</p></div>
		<div class=\"col-1 col-header\"><p>Entry Time</p></div>
		<div class=\"col-1\"></div>
	</div>";

	// Select from Database
	$sql = "SELECT id, first_name, last_name, email, status, birth_day, birth_month, sys_ts FROM newsletter_subscription";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		$count = 0;
		while($row = $result->fetch_assoc()) {
			if ($count % 2 == 0) {
				echo "
				<div class=\"row\">
					<div class=\"col-1\"></div>
					<div class=\"col-1 col-even\"><p>&nbsp;" . $row["id"] . "</p></div>
					<div class=\"col-1 col-even\"><p>&nbsp;" . $row["first_name"] . "</p></div>
					<div class=\"col-1 col-even\"><p>&nbsp;" . $row["last_name"] . "</p></div>
					<div class=\"col-1 col-even\"><p>&nbsp;" . $row["email"] . "</p></div>
					<div class=\"col-1 col-even\"><p>&nbsp;" . $row["status"] . "</p></div>
					<div class=\"col-1 col-even\"><p>&nbsp;" . $row["birth_day"] . "</p></div>
					<div class=\"col-1 col-even\"><p>&nbsp;" . $row["birth_month"] . "</p></div>
					<div class=\"col-1 col-even\"><p>&nbsp;" . $row["sys_ts"] . "</p></div>
					<div class=\"col-1\"></div>
				</div>";
			} else {
				echo "
				<div class=\"row\">
					<div class=\"col-1\"></div>
					<div class=\"col-1 col-odd\"><p>&nbsp;" . $row["id"] . "</p></div>
					<div class=\"col-1 col-odd\"><p>&nbsp;" . $row["first_name"] . "</p></div>
					<div class=\"col-1 col-odd\"><p>&nbsp;" . $row["last_name"] . "</p></div>
					<div class=\"col-1 col-odd\"><p>&nbsp;" . $row["email"] . "</p></div>
					<div class=\"col-1 col-odd\"><p>&nbsp;" . $row["status"] . "</p></div>
					<div class=\"col-1 col-odd\"><p>&nbsp;" . $row["birth_day"] . "</p></div>
					<div class=\"col-1 col-odd\"><p>&nbsp;" . $row["birth_month"] . "</p></div>
					<div class=\"col-1 col-odd\"><p>&nbsp;" . $row["sys_ts"] . "</p></div>
					<div class=\"col-1\"></div>
				</div>";
			}
			$count ++;
		}
		echo "
		<div class=\"row padtop-1\">
			<div class=\"col-1\"></div>
			<div class=\"col-8 col-header t-right\"><p>Total Records:&nbsp;" . $count . "</p></div>
			<div class=\"col-1\"></div>
		</div>";
	} else {
		echo "
		<div class=\"row padtop-1\">
			<div class=\"col-1\"></div>
			<div class=\"col-8 sub-col-grad t-right\"><h4>No Records Found in the Table</h4></div>
			<div class=\"col-1\"></div>
		</div>
		";
	}
	$conn->close();
?>
		<div class="row">
			<div class="col-10 hgrid-5">&nbsp;</div>
		</div>
	</div>
</section>
<footer>
		<div id="ftr-area" class="grid-container footer-area">
			<div class="row">
				<div class="col-10 hgrid-3">&nbsp;</div>
			</div>
			<div class="row">
				<div class="col-1"></div>
				<div class="col-2">
					<p>
						<a class="social-link" href="http://www.facebook.com/" target="_blank">
							<img src="images/SFacebookA.png" alt="Facebook" width="40" />
							<img src="images/SFacebook.png" alt="Facebook" width="40" />
						</a>&nbsp;
						<a class="social-link" href="http://www.twitter.com/" target="_blank">
							<img src="images/STwitterA.png" alt="Twitter" width="40" />
							<img src="images/STwitter.png" alt="Twitter" width="40" />
						</a>&nbsp;
						<a class="social-link" href="http://www.youtube.com/" target="_blank">
							<img src="images/SYouTubeA.png" alt="Youtube" width="40" />
							<img src="images/SYouTube.png" alt="Youtube" width="40" />
						</a>&nbsp;
						<a class="social-link" href="http://www.linkedin.com/" target="_blank">
							<img src="images/SLinkedinA.png" alt="Linked In" width="40" />
							<img src="images/SLinkedin.png" alt="Linked In" width="40" />
						</a>
					</p>
				</div>
				<div class="col-6 t-right">
					<p>Email: <a class="ext-link" href="mailto:romit@bu.edu">romit@bu.edu</a></p>
					<p>Copyright &copy; 2015, Boston University</p>
				</div>
				<div class="col-1"></div>
			</div>
			<div class="row">
				<div class="col-10 hgrid-1">&nbsp;</div>
			</div>
		</div>
	</footer>
</body>
</html>