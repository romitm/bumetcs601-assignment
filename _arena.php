<?php
	$password1 = "userromit";
	echo "Password:  " . $password1 . "<br/>";
	$encryptedpwd1 = hash("sha256", $password1);
	echo "Encrypted: " . $encryptedpwd1 . "<br/>";

	$password2 = "siteadmin";
	echo "Password:  " . $password2 . "<br/>";
	$encryptedpwd2 = hash("sha256", $password2);
	echo "Encrypted: " . $encryptedpwd2;
?>