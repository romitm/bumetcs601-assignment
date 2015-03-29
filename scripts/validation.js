/* Validation JS File */
// Validate First Name
function validateFirstName() {
	var re = new RegExp("^[a-zA-Z]*$");
	var flag = false;
	var fName = document.getElementById("firstname").value;
	if (fName == "") {
		document.getElementById("firstname-error").innerHTML = "<h5>*&nbsp;Sorry you did not enter anything in the field.</h5>";
		document.getElementById("err-div-1").className = "col-3 sub-col-grad";
	} else {
		if (re.exec(fName)) {
			flag = true;
			document.getElementById("firstname-error").innerHTML = "";
			document.getElementById("err-div-1").className = "col-3";
		} else {
			document.getElementById("firstname-error").innerHTML = "<h5>*&nbsp;Sorry only alphabets allowed.</h5>";
			document.getElementById("err-div-1").className = "col-3 sub-col-grad";
		}
	}
	return flag;
}
// Validate Last Name.
function validateLastName() {
	var re = new RegExp("^[a-zA-Z]*$");
	var flag = false;
	var fName = document.getElementById("lastname").value;
	if (fName == "") {
		document.getElementById("lastname-error").innerHTML = "<h5>*&nbsp;Sorry you did not enter anything in the field.</h5>";
		document.getElementById("err-div-2").className = "col-3 sub-col-grad";
	} else {
		if (re.exec(fName)) {
			flag = true;
			document.getElementById("lastname-error").innerHTML = "";
			document.getElementById("err-div-2").className = "col-3";
		} else {
			document.getElementById("lastname-error").innerHTML = "<h5>*&nbsp;Sorry only alphabets allowed.</h5>";
			document.getElementById("err-div-2").className = "col-3 sub-col-grad";
		}
	}
	return flag;
}
// Validate Birth Day and Birth Month.
/* 	Reading the Select Option values, the excerpt has been learnt and modified from:
	http://stackoverflow.com/questions/1085801/get-selected-value-of-dropdownlist-using-javascript */
function validateBirthDayMonth() {
	var flag = false;
	var bd = document.getElementById("birthday").value;
	var pbd = parseInt(bd);
	var bmid = document.getElementById("birthmonth");
	var bm = bmid.options[bmid.selectedIndex].value;
	//alert(bd + " " + bm);
	if (bd.trim() != "" && isNaN(pbd)) {
		document.getElementById("bd-error").innerHTML = "<h5>*&nbsp;Sorry enter a number only.</h5>";
		document.getElementById("err-div-3").className = "col-3 sub-col-grad";
	} else if (bd.trim() == "" && bm > 0) {
		document.getElementById("bm-error").innerHTML = "<h5>*&nbsp;Please select a birthday now or deselect month.</h5>";
		document.getElementById("err-div-4").className = "col-3 sub-col-grad";
	} else if (bd.trim() == "" && bm == 0) {
		flag = true;
		document.getElementById("bd-error").innerHTML = "";
		document.getElementById("err-div-3").className = "col-3";
		document.getElementById("bm-error").innerHTML = "";
		document.getElementById("err-div-4").className = "col-3";
	} else {
		// pbd is a number and needs to be validated.
		if (pbd > 31 || pbd < 1) {
			document.getElementById("bd-error").innerHTML = "<h5>*&nbsp;Sorry enter a number only between 1 an 31.</h5>";
			document.getElementById("err-div-3").className = "col-3 sub-col-grad";
		} else if ((pbd > 30) && (bm == 2 || bm == 4 || bm == 6 || bm == 9 || bm == 11)) {
			document.getElementById("bm-error").innerHTML = "<h5>*&nbsp;Month and Day combination inconsistent.</h5>";
			document.getElementById("err-div-4").className = "col-3 sub-col-grad";
		} else if ((pbd > 28) && (bm == 2)) {
			document.getElementById("bm-error").innerHTML = "<h5>*&nbsp;This is February we are talking about!</h5>";
			document.getElementById("err-div-4").className = "col-3 sub-col-grad";
		} else if ((pbd > 0 && pbd < 32) && bm == 0) {
			document.getElementById("bd-error").innerHTML = "<h5>*&nbsp;Please select a month now.</h5>";
			document.getElementById("err-div-3").className = "col-3 sub-col-grad";
		} else {
			flag = true;
			document.getElementById("bd-error").innerHTML = "";
			document.getElementById("err-div-3").className = "col-3";
			document.getElementById("bm-error").innerHTML = "";
			document.getElementById("err-div-4").className = "col-3";
		}
	}
	return flag;
}
// Validate Email address.
function validateEmail() {
	var re = /\S+@\S+\.\S+/;
	var flag = false;
	var emailAdd = document.getElementById("email").value;
	if (emailAdd == "") {
		document.getElementById("email-error").innerHTML = "<h5>*&nbsp;Sorry you did not enter anything in the field.</h5>";
		document.getElementById("err-div-5").className = "col-3 sub-col-grad";
	} else {
		if (re.test(emailAdd)) {
			flag = true;
			document.getElementById("email-error").innerHTML = "";
			document.getElementById("err-div-5").className = "col-3";
		} else {
			document.getElementById("email-error").innerHTML = "<h5>*&nbsp;Please enter a valid email address.</h5>";
			document.getElementById("err-div-5").className = "col-3 sub-col-grad";
		}
	}
	return flag;
}
// Validations before submission for Subscription
function subscribeUser() {
	var vIndex = 0;
	if (validateFirstName()) {
		vIndex ++;
	}
	if (validateLastName()) {
		vIndex ++;
	}
	if (validateBirthDayMonth()) {
		vIndex ++;	
	}
	if (validateEmail()) {
		vIndex ++;
	}
	// Finally submit form when the everything is ok.
	if (vIndex == 4) {
		document.getElementById("userinput").value = "subscribe";
		document.forms["subscribe-newsletter"].submit();	
	}
}
// Validate Email Only for Unsubscribe
function unsubscribeUser() {
	if (validateEmail()) {
		document.getElementById("userinput").value = "unsubscribe";
		document.forms["subscribe-newsletter"].submit();	
	}
}