<?php
	session_start();	
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<!-- Main Stylesheet -->
<link rel="stylesheet" type="text/css" href="styles/submain.min.css">
<!-- Learning to add Google Font on the page -->
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<!-- For the Hero Area -->
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:300' rel='stylesheet' type='text/css'>
<meta name="description" content="Boston University">
<meta name="keywords" content="BU, CS601, Web Application Development, Spring, 2015">
<!-- Learning to add a favicon -->
<link rel="icon" href="images/favicon.ico?v=3" type="image/x-icon" />
<meta charset="UTF-8">
<script>
function clearFormValues() {
	document.getElementById("siteusername").value = "";
	document.getElementById("sitepassword").value = "";
	//document.getElementById("sitelogin").disabled = true;
	//document.getElementById("siteclearform").disabled = true;
}
function activateFormButtons() {
	var usrname = document.getElementById("siteusername").value;
	var usrpwd = document.getElementById("sitepassword").value;
	if (usrname.trim() != "" && usrpwd != "") {
		document.getElementById("sitelogin").disabled = false;
		document.getElementById("siteclearform").disabled = false;
	}
}
function disableButtonsOnLoad() {
	//document.getElementById("sitelogin").disabled = true;
	//document.getElementById("siteclearform").disabled = true;
}
</script>
</head>
<body onload="javascript:disableButtonsOnLoad();">
	<header>
		<div class="grid-container hgrid-5 bgblack">
			<div class="row padtop-2 bgblack">
				<div class="col-8 bgblack">
					<div class="header"><p>Administrator Zone</p></div>
				</div>
				<div class="col-2 bgblack">
					<p>
						<a href="home.html">
							<img src="images/logo.png" alt="Site Logo" width="200" />
						</a>
					</p>
				</div>
			</div>
			<div id="navbar" class="row bgblue">
				<div class="col-10 menu-col-grad">
					<div class="t-right menu-padding menu-item">
						<nav>
							<ul>
								<li class="active-link">Login</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section>
		<form id="site-login" action="_loginset.php" method="POST">
			<div class="grid-container sub-list-col-hard">
				<div class="row">
					<div class="col-10 hgrid-7">&nbsp;</div>
				</div>
				<!-- In case of Login Error the DIV below will show up -->
				<?php
					if (!empty($_SESSION["usererror"]) && $_SESSION["usererror"] == "ERR01") {
						echo "
						<div class=\"row padtop-4\">
							<div class=\"col-1\"></div>
							<div class=\"col-8\"><h4>Incorrect Login Information has been used. Please try Again.</h4></div>
							<div class=\"col-1\"></div>
						</div>";
						$_SESSION["usererror"] = "";
					} else {
						echo "
						<div class=\"row\">
							<div class=\"col-10 hgrid-5\">&nbsp;</div>
						</div>";
					}
				?> 
				<!-- In case of Login Error the DIV above will show up -->
				<div class="row">
					<div class="col-1"></div>
					<div class="col-3 sub-col-grad">
						<h3>Administrator Login</h3>
					</div>
					<div class="col-6"></div>
				</div>
				<div class="row padtop-1">
					<div class="col-1"></div>
					<div class="col-1"><p>Username:<span class="mandatory">&nbsp;*</span></p></div>
					<div class="col-4">
						<input type="text" id="siteusername" name="siteusername" class="medium-wide" placeholder="Username" maxlength="20" minlength="6" required autofocus />
					</div>
					<div class="col-3"></div>
				</div>
				<div class="row padtop-1">
					<div class="col-1"></div>
					<div class="col-1"><p>Password:<span class="mandatory">&nbsp;*</span></p></div>
					<div class="col-4">
						<input type="password" id="sitepassword" name="sitepassword" class="medium-wide" placeholder="Password" maxlength="20" minlength="6" required />
					</div>
					<div class="col-3"></div>
				</div>
				<div class="row">
					<div class="col-10 hgrid-1">&nbsp;</div>
				</div>
				<div class="row">
					<div class="col-1"></div>
					<div class="col-1">
						<input type="submit" id="sitelogin" name="sitelogin" value="Login" />
					</div>
					<div class="col-1">
						<input type="button" id="siteclearform" name="siteclearform" value="Clear" class="warning-button" onclick="javascript:clearFormValues();" />
					</div>
					<div class="col-6"></div>
					<div class="col-1"></div>
				</div>
				<div class="row">
					<div class="col-10 hgrid-5">&nbsp;</div>
				</div>
				<div class="row">
					<div class="col-10 hgrid-7">&nbsp;</div>
				</div>
			</div>
		</form>
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