<!DOCTYPE html>
<html>
<head>
<title>Newsletter Subscribe</title>
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
				<div class="header"><p>Newsletter Subscription</p></div>
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
							<li><a class="menu-link" href="home.html">Home</a></li>
							<li><a class="menu-link" href="profile.html">Profile</a></li>
							<li><a class="menu-link" href="subscribe.html">Subscribe</a></li>
							<li><a class="menu-link" href="gallery.html">Gallery</a></li>
							<li><a class="menu-link" href="feature.html">Feature</a></li>
							<li><a class="menu-link" href="jwelcome.html">JSWorks</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</header>
<section>
	<div class="grid-container">
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

	function sendMail($email) {
		$serverdatetime = date("l jS \of F Y h:i:s A");
		// Single Recipients
		$to = $email;
		// Subject
		$subject = "Newsletter Subscription: Successful";
		// Message
		$message = "
			<html>
			<head>
			<title>Subscription Mail</title>
			</head>
			<body>
				<p>Thank You! The Subscription request is as follows:</p>
				<table>
					<tr>
						<th>Item</th>
						<th>Status</th>
						<th>Date</th>
					</tr>
					<tr>
						<td>Video & Timelapse Subscription</td>
						<td>Active</td>
						<td>" . $serverdatetime . "</td>
					</tr>
					<tr>
						<td>HDR Photography and Weekly digest</td>
						<td>Active</td>
						<td>" . $serverdatetime . "</td>
					</tr>
					<tr>
						<td>Special Promotions to Workshops & Tutorials</td>
						<td>Active</td>
						<td>" . $serverdatetime . "</td>
					</tr>
				</table>
			</body>
			</html>
		";
		// To send HTML Email, the Content-type header must be set
		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		// Additional headers
		$headers .= "From: Newsletter Subscription <newsletter@vista.com>" . "\r\n";
		// Send Mail
		mail($to, $subject, $message, $headers);
	}

	/* Objects from the Form */
	$userInput = trim($_POST["userinput"]);
	$firstName = trim($_POST["firstname"]);
	$lastName = trim($_POST["lastname"]);
	$bDay = trim($_POST["birthday"]);
	$bMon = trim($_POST["birthmonth"]);
	$emailAddress = trim($_POST["email"]);
	$bMonth = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST" && $userInput == "subscribe" && !empty($firstName) && !empty($lastName) && !empty($emailAddress)) {

		/* Get the Database Connection */
		$mysqli = openMySQLDBConnection();

		if (empty($bDay)) {
			$bDay = NULL;
		}

		switch ($bMon) {
			case "0": $bMonth = NULL; break;
			case "1": $bMonth = "January"; break;
			case "2": $bMonth = "February"; break;
			case "3": $bMonth = "March"; break;
			case "4": $bMonth = "April"; break;
			case "5": $bMonth = "May"; break;
			case "6": $bMonth = "June"; break;
			case "7": $bMonth = "July"; break;
			case "8": $bMonth = "August"; break;
			case "9": $bMonth = "September"; break;
			case "10": $bMonth = "October"; break;
			case "11": $bMonth = "November"; break;
			case "12": $bMonth = "December"; break;
		}

		echo "
		<div class=\"row\">
			<div class=\"col-10 hgrid-3\">&nbsp;</div>
		</div>
		<div class=\"row padtop-4\">
			<div class=\"col-1\"></div>
			<div class=\"col-2 col-header\"><p>Name:&nbsp;" . $firstName . " " . $lastName . "</p></div>
			<div class=\"col-2 col-header\"><p>Email:&nbsp;" . $emailAddress . "</p></div>
			<div class=\"col-1 col-header\"><p>Birth Day:&nbsp;" . $bDay . "</p></div>
			<div class=\"col-3 col-header\"><p>Birth Month:&nbsp;" . $bMonth . "</p></div>
			<div class=\"col-1\"></div>
		</div>";

		/* Select query to check if email exists already */
		$stmt = $mysqli->prepare("SELECT count(1), id, status FROM newsletter_subscription WHERE email = ?");
		$stmt->bind_param("s", strtolower($emailAddress));
		$stmt->execute();
		/* bind variables to prepared statement */
	    $stmt->bind_result($emailCount, $retId, $retStatus);

	    /* fetch values */
	    while ($stmt->fetch()) {
	        if ($emailCount == 1 && strtoupper($retStatus) == "Y") {
		        echo "
		        <div class=\"row padtop-4\">
					<div class=\"col-1\"></div>
					<div class=\"col-8\"><img src=\"images/cross.jpeg\" alt=\"No Action\" width=\"60\" />&nbsp;<p>No Action Required!</p></div>
					<div class=\"col-1\"></div>
				</div>
		        <div class=\"row padtop-1\">
					<div class=\"col-1\"></div>
					<div class=\"col-8 sub-col-grad\"><h4>Email Already exists. And the the Status of the Subscription is already: '" . $retStatus . "'</h4></div>
					<div class=\"col-1\"></div>
				</div>
				<div class=\"row\">
					<div class=\"col-10 hgrid-5\">&nbsp;</div>
				</div>";
			}
	    }
	    /* close statement */
		$stmt->close();

	    if ($emailCount == 1 && strtoupper($retStatus) == "N") {
			echo "
			<div class=\"row padtop-4\">
				<div class=\"col-1\"></div>
				<div class=\"col-8\"><img src=\"images/exclaim.jpeg\" alt=\"Exclaim\" width=\"60\" />&nbsp;<p>Please Note!</p></div>
				<div class=\"col-1\"></div>
			</div>
	        <div class=\"row padtop-1\">
				<div class=\"col-1\"></div>
				<div class=\"col-8 sub-col-grad\"><h4>Email Already exists. And the the Status of the Subscription is: " . $retStatus . " So this will go for Activation in a while.</h4></div>
				<div class=\"col-1\"></div>
			</div>
			<div class=\"row\">
				<div class=\"col-10 hgrid-5\">&nbsp;</div>
			</div>";

			/* Update statement to be ensued here. */
			$updateStmt = $mysqli->prepare("UPDATE newsletter_subscription SET status = 'Y' WHERE id = ? AND email = ?");
			$updateStmt->bind_param("is", $retId, strtolower($emailAddress));
			$updateStmt->execute();
			$updateStmt->close();
		} else if ($emailCount == 0) {
			/* Insert Statement into the Table */
			$inStmt = $mysqli->prepare("INSERT INTO newsletter_subscription (first_name, last_name, email, status, birth_day, birth_month) VALUES (?, ?, ?, 'Y', ?, ?)");
			$inStmt->bind_param("sssss", $firstName, $lastName, strtolower($emailAddress), $bDay, $bMonth);
			$inStmt->execute();
			$inStmt->close();

			echo "
			<div class=\"row padtop-4\">
				<div class=\"col-1\"></div>
				<div class=\"col-8\"><img src=\"images/check.jpeg\" alt=\"Success\" width=\"60\" />&nbsp;<p>Success!</p></div>
				<div class=\"col-1\"></div>
			</div>
	        <div class=\"row padtop-1\">
				<div class=\"col-1\"></div>
				<div class=\"col-8 sub-col-grad\"><h3>The Subscriber information has been loaded successfully. Activation will proceed!</h3></div>
				<div class=\"col-1\"></div>
			</div>
			<div class=\"row\">
				<div class=\"col-10 hgrid-5\">&nbsp;</div>
			</div>";

			/* Send Email */
			sendMail(strtolower($emailAddress));
		}

		closeMySQLConnection($mysqli);
	} else if ($_SERVER["REQUEST_METHOD"] == "POST" && $userInput == "unsubscribe" && !empty($emailAddress)) {

		/* Get the Database Connection */
		$mysqli = openMySQLDBConnection();

		/* Update statement to be ensued here. */
		$unsStmt = $mysqli->prepare("UPDATE newsletter_subscription SET status = 'N' WHERE email = ?");
		$unsStmt->bind_param("s", strtolower($emailAddress));
		$unsStmt->execute();
		$unsStmt->close();

		echo "
		<div class=\"row\">
			<div class=\"col-10 hgrid-3\">&nbsp;</div>
		</div>
		<div class=\"row padtop-4\">
			<div class=\"col-1\"></div>
			<div class=\"col-8\"><img src=\"images/check.jpeg\" alt=\"Success\" width=\"60\" />&nbsp;<p>Success!</p></div>
			<div class=\"col-1\"></div>
		</div>
        <div class=\"row padtop-1\">
			<div class=\"col-1\"></div>
			<div class=\"col-8 sub-col-grad\"><h3>You have been successfully Unsubscribed from the Newsletter emails. Thank you.</h3></div>
			<div class=\"col-1\"></div>
		</div>
		<div class=\"row padtop-1\">
			<div class=\"col-1\"></div>
			<div class=\"col-8 sub-col-grad\"><h3>Your Email Address '" . strtolower($emailAddress) . "' has been deactivated!</h3></div>
			<div class=\"col-1\"></div>
		</div>
		<div class=\"row\">
			<div class=\"col-10 hgrid-5\">&nbsp;</div>
		</div>";

		closeMySQLConnection($mysqli);
	}
?>
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
<!-- Copyright Protected 2015 Boston University, Romit Maity BU MET CS -->