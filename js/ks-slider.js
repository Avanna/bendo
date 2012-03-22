(function($){
	
	$(document).ready(function() {
	
		 $('#slider').nivoSlider({
			effect: 'sliceUpLeft',
			animSpeed: 400, // Slide transition speed
			pauseTime: 5000,
			controlNav: true,
			controlNavThumbs: true,
			captionOpacity: 0
		});
	});
	
})(jQuery);