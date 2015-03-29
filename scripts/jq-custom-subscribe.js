$(document).ready(function() {
	// Nothing Here
});

function showDiv(invokeId){
	var msgdisplayid = "#" + invokeId + "message";

	// Get the Invoke ID Position
    var invokeId = '#' + invokeId;
    var invokeId = $(invokeId).position();

    // New Position to teh to and left of the ID.
    var newTop = invokeId.top + 30;
    var newLeft = invokeId.left + 300;

    $(msgdisplayid).css("top", newTop);
    $(msgdisplayid).css("right", newLeft);

    $(msgdisplayid).fadeIn(1000);
}

function hideDiv(invokeId){
	var msgdisplayid = "#" + invokeId + "message";
    $(msgdisplayid).fadeOut(1000);
}