$(document).ready(function() {
	// increase factor
	var factor = 1.1;
	$("#socialimage").mouseenter(function() {
	    $(this).animate({
	        top: '-=' + $(this).height() / factor,
	        left: '-=' + $(this).width() / factor,
	        width: 230
	    });
	});
	$("#socialimage").mouseleave(function() {
	    $(this).animate({
	        top: '-=' + $(this).height() * factor,
	        left: '-=' + $(this).width() * factor,
	        width: 200
	    });
	});
});