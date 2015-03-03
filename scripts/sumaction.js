/* Copyright Protected 2015 Boston University, Romit Maity BU MET CS */

// Mute Objects on Body Onload
function muteFormObjects() {
	document.getElementById("username").value = "";
	document.getElementById("add-area").className = "hide";
	document.getElementById("firstnumber").value = "";
	document.getElementById("secondnumber").value = "";
	document.getElementById("ftr-area").className = "hide";
}

// Validate the User and prompt the Welcome message
// Utilized RegEx Validations for the Name entry from the following website (Only Line 12 below):
// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions
function validateUser() {
	var re = new RegExp("^[a-zA-Z]*$");
	var uName = document.getElementById("username").value;
	if (uName == "") {
		document.getElementById("welcome-user").innerHTML = "<h4>Sorry you did not enter anything in the field.</h4>";
		document.getElementById("add-area").className = "hide";
	} else {
		if (re.exec(uName)) {
			document.getElementById("welcome-user").innerHTML = "How are you today, <strong>" + uName + "</strong>?";
			document.getElementById("add-area").className = "show";
			document.getElementById("firstnumber").focus();
		} else {
			document.getElementById("welcome-user").innerHTML = "<h4>Sorry you had unidentified characters in your name. Please refrain from using spaces.</h4>";
			document.getElementById("add-area").className = "hide";
		}
	}
}

// Add the Entered values - If String then concatenate else provide summation
function addEnteredValues() {
	var efNum = document.getElementById("firstnumber").value;
	var esNum = document.getElementById("secondnumber").value;
	var fNum = parseInt(efNum);
	var sNum = parseInt(esNum);
	var msg = "The Sum of two numbers entered: <strong>";
	var err = "The Entries provided are inconsistent. However we have concatenated the String for you: <strong>";
	if (efNum.trim() == "") {
		msg = "<h4>You haven't entered the First number. Please try again if you want to.</h4>";
		document.getElementById("firstnumber").focus();
	} else if (esNum.trim() == "") {
		msg = "<h4>You haven't entered the Second number. Please try again if you want to.</h4>";
		document.getElementById("secondnumber").focus();
	} else {
		if (!isNaN(fNum) && !isNaN(sNum)) {
			var sum = fNum + sNum;
			msg += sum;
		} else {
			msg = err + efNum + esNum;
		}
	}
	document.getElementById("summation").innerHTML = msg + "</strong>";
}

// Finally thank the User
function thankUser() {
	document.getElementById("thanks").innerHTML = "<h3>Thank you for using the Program! Have a Nice Day.</h3>";
	document.getElementById("ftr-area").className = "show";
}