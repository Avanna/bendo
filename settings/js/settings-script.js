// Function that will change color do a div whenver someone makes a change to the input fields
function activate_save_animation(e){
	
jQuery('.button-zone').animate({
	backgroundColor: '#f3d9d9',
	borderLeftColor: '#555',
	borderRightColor: '#555'
});
jQuery('.button-zone button').addClass('save-me-fool');
}

jQuery(document).ready(function($) {
	if($('.checkme').is(':checked')){
		$("#extra").show("fast");
	}
	else
	{
		$("#extra").css("display","none");
	}
});

// This bit of code shows extra options if the checkbox is checked
jQuery(document).ready(function($){
$(".checkme").click(function(){
if ($(".checkme").is(":checked")) {
	$("#extra").show("fast");
}
else {
	$("#extra").hide("fast");
}
});
	
// If there was a change to the input fields fire up the 'activate_save_animation' functions
$('#od-panel input, #od-panel select,#od-panel textarea').live('change', function(e){
	activate_save_animation(e);
});

// Script for Tabs
$(".tab_content").hide(); //Hide all content
$("ul.tabs li:first").addClass("active").show(); //Activate first tab
$(".tab_content:first").show(); //Show first tab content
$("ul.tabs li").click(function() {
$("ul.tabs li").removeClass("active"); //Remove any "active" class
$(this).addClass("active"); //Add "active" class to selected tab
$(".tab_content").hide(); //Hide all tab content

var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
$(activeTab).fadeIn(); //Fade in the active ID content
return false;
});

// Script for color picker	
$('#colorpicker').ColorPicker({
	color: '#ffffff',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
			return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#colorpicker').attr('value', '#' + hex);
	}
});
});
