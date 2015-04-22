/* Custom Jquery and JS - For the Site Specific features - Romit Maity, BU MET CS 601 January 2015 */
// Declarations and Function specifications.
var showallimg; // Only when all images are shown the left and right arrows will work.
var arrimg = ["images/pg1001.jpg", "images/pg1002.jpg", "images/pg1003.jpg", "images/pg1004.jpg", "images/pg1005.jpg"]; // Initial Array of the Images.
// Objects to show the Image Descriptions.
var img01 = {title: "West Boylston, Mass.", description: "The Old Stone Church was built in the early 1890s to replace the Baptist church which had been lost in a fire. Ten years later it had to be abandoned for the reservoir. It stands alone on a point of land by the side of the water as a reminder of what was lost to the reservoir."};
var img02 = {title: "Westborough, Mass.", description: "Sandra Pond is the town reservoir. This area lies 138 feet above the town center. The conservation land is 144 acres purchased in 1969 to protect the town's water supply. This is an effort to take the Night Sky with Star Trails and achieving the feat of Light Painting."};
var img03 = {title: "Wellesley, Mass.", description: "UU Wellesley is a faith community that draws seekers from Wellesley and neighboring towns in Massachusetts. This was a cool photo-op on Washington St. when the dark rain clouds cleared leaving the ambience crisp, the distant lights illuminated this evening scene."};
var img04 = {title: "Charlestown, Mass.", description: "Charlestown is the oldest neighborhood in Boston, Mass. It is located on a peninsula north of the Charles River, across from downtown Boston. This is a view of the Leonard P. Zakim Bunker Hill Memorial Bridge, a part of the Big Dig Project, from Charlestown."};
var img05 = {title: "Boston, Mass.", description: "Boston is the capital and largest city of the Commonwealth of Massachusetts. Boston also serves as county seat of Suffolk County. The largest city in New England, the city proper, covering 48 square miles and is the 24th largest city in the United States."};
// Even or Odd Image Description only.
var eoImg = {title: "Even or Odd Images Display", description: "All Even / Odd images from the Collection are being displayed on the gallery. At this time the Left and Right Arrow click features have been disabled on the Gallery. Check the 'All' on the radio and then hit the 'View' button to toggle to the full Gallery view."};

// Hide the Central Image Section/
function imageSectionsHide() {
	$("div#fillerbg").removeClass("hide").addClass("show");
	$("div#heroimg").removeClass("show").addClass("hide");
	$("div#thumbimg").removeClass("show").addClass("hide");
	$("div#remainder").removeClass("show").addClass("hide");
	$("div#imgdescription").removeClass("show").addClass("hide");
}

// Show the central image section.
function imageSectionsShow() {
	$("div#fillerbg").removeClass("show").addClass("hide");
	$("div#heroimg").removeClass("hide").addClass("show");
	$("div#thumbimg").removeClass("hide").addClass("show");
	$("div#remainder").removeClass("hide").addClass("show");
}

// Show the Description Section with the objects declared prior.
function showDescriptionSection() {
	$("div#imgdescription").removeClass("hide").addClass("show");
	$("p#imgtitle").empty();
	$("p#imgcallout").empty();
	if (showallimg) {
		if (arrimg[0].indexOf("pg1001") > 0) {
			$("p#imgtitle").append(img01.title);
			$("p#imgcallout").append(img01.description);
		} else if (arrimg[0].indexOf("pg1002") > 0) {
			$("p#imgtitle").append(img02.title);
			$("p#imgcallout").append(img02.description);
		} else if (arrimg[0].indexOf("pg1003") > 0) {
			$("p#imgtitle").append(img03.title);
			$("p#imgcallout").append(img03.description);
		} else if (arrimg[0].indexOf("pg1004") > 0) {
			$("p#imgtitle").append(img04.title);
			$("p#imgcallout").append(img04.description);
		} else if (arrimg[0].indexOf("pg1005") > 0) {
			$("p#imgtitle").append(img05.title);
			$("p#imgcallout").append(img05.description);
		}
	} else {
		$("p#imgtitle").append(eoImg.title);
		$("p#imgcallout").append(eoImg.description);
	}
}

// Function to Show All Images.
function showAllImages(textFadeTime, imgFadeTime) {
	$("span#paneltext").fadeIn(1, function() {
		$("img#slot1").attr("width", 400).attr("src", arrimg[0]).fadeIn(5, function() {
			$("img#slot2").attr("src", arrimg[1]).fadeIn(imgFadeTime, function() {
				$("img#slot3").attr("src", arrimg[2]).fadeIn(imgFadeTime, function() {
					$("img#slot4").attr("src", arrimg[3]).fadeIn(imgFadeTime, function() {
						$("img#slot5").attr("src", arrimg[4]).fadeIn(imgFadeTime, function() {
							showDescriptionSection();
							$("span#paneltext").fadeOut(textFadeTime);
							console.log("Gallery Published Successfully.");
						});
					});
				});
			});
		});
	});
	imageSectionsShow();
}

// Function to show Only Even Images.
function showEvenImages(textFadeTime, imgFadeTime) {
	$("img#slot1").attr("src", arrimg[1]).fadeIn(1, function() {
		$("img#slot2").attr("src", arrimg[3]).fadeIn(imgFadeTime, function() {
			showDescriptionSection();
			$("span#paneltext").fadeOut(textFadeTime);
			console.log("All Even Images have been published.");
		});
	});
	imageSectionsShow();
}

// Function to show only Odd Images.
function showOddImages(textFadeTime, imgFadeTime) {
	$("img#slot1").attr("src", arrimg[0]).fadeIn(1, function() {
		$("img#slot2").attr("src", arrimg[2]).fadeIn(imgFadeTime, function() {
			$("img#slot3").attr("src", arrimg[4]).fadeIn(imgFadeTime, function() {
				showDescriptionSection();
				$("span#paneltext").fadeOut(textFadeTime);
				console.log("All Odd Images have been published.");
			});
		});	
	});
	imageSectionsShow();
}

// Function to Hide the Text Panel.
function hideTextPanels() {
	$("span#paneltext").addClass("hide");
	$("span#paneleven").removeClass("show").addClass("hide");
	$("span#panelodd").removeClass("show").addClass("hide");
}

// Function to Hide the 'Hide Gallery' section.
function muteHideGalleryArea() {
	$("div#hidegallerytext").removeClass("show").addClass("hide");
	$("div#hidegallerylink").removeClass("show").addClass("hide");
}

// Function to Show the 'Hide Gallery' section.
function activateHideGalleryArea() {
	$("div#hidegallerytext").removeClass("hide").addClass("show");
	$("div#hidegallerylink").removeClass("hide").addClass("show");
}

// Function when Left Or Right Arrow is clicked.
function swivel(keyhit) {
	if (keyhit === 37) {
		console.log("Left Swivel at " + new Date().getTime());
		var ltswap = arrimg[0];
		arrimg.push(ltswap);
		arrimg.shift();
	} else if (keyhit === 39) {
		console.log("Right Swivel at " + new Date().getTime());
		var rtswap = arrimg[arrimg.length - 1];
		arrimg.pop();
		arrimg.unshift(rtswap);
	}
	showAllImages(100, 200);
}

// At the DOM load to be executed.
$(document).ready(function() {
	// Hide the 'Hide Gallery Buttons' area.
	muteHideGalleryArea();
	// Hide the 'Span Area' for the different messaging.
	hideTextPanels();
	// Main 'Image Area' to remain hidden initially.
	imageSectionsHide();
});

// This will trigger the event to be fired when the 'View' button is clicked.
$("#btnviewgallery").click(function () {
	$("div#heroimg img").fadeOut(2);
	$("div#remainder img").fadeOut(2);
	var sval = $('input:radio[name=imageselector]:checked').val();
	console.log("Value of the radio selection: [" + sval + "]");
	// Depending on the value of sval - show relevant images.
	if (sval === "all") {
		showAllImages(400, 600);
		showallimg = true;
	} else if (sval === "even") {
		showEvenImages(200, 400);
		showallimg = false;
	} else if (sval === "odd") {
		showOddImages(200, 400);
		showallimg = false;
	} else {
		showallimg = false;
	}
	activateHideGalleryArea();
	hideTextPanels();
	$("span#paneltext").removeClass("hide").addClass("show highlight-letter");
});

// Hide the Gallery Button event.
$("#btnhidegallery").click(function() {
	imageSectionsHide();
	muteHideGalleryArea();
});

// This event will get the Radio selection and report to the dialog box.
$("input:radio[name=imageselector]").click(function() {
	$("span#paneltext").fadeOut(1);
	hideTextPanels();
	var sv = $('input:radio[name=imageselector]:checked').val();
	if (sv === "even") {
		$("span#paneleven").addClass("show highlight-letter");
		$("span#panelodd").addClass("hide");
	} else if (sv === "odd") {
		$("span#panelodd").addClass("show highlight-letter");
		$("span#paneleven").addClass("hide");
	}
});

// Right & Left Arrow functionality.
$(document).keydown(function(event) {
	switch(event.which) {
		case 37:
		if (showallimg) {
			swivel(37);
		}
		break;
		case 38: break;
		case 39:
		if (showallimg) {
			swivel(39);
		}
		break;
		case 40: break;
		default: return; // Exit function handler			
	}
	event.preventDefault();
});