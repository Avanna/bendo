(function ($){

	$(document).ready(function(){
		
		$("a.lightbox").fancybox({
				'showCloseButton':  true,
				'showNavArrows' :   true,
				'transitionIn'	:	'elastic',
				'transitionOut'	:	'elastic',
				'speedIn'		:	600, 
				'speedOut'		:	200, 
				'overlayShow'	:	true,
				'cyclic'		:   true,
				'overlayOpacity':   0.8,
				'overlayColor'  :   '#111',
				'autoScale'		:   true
			});
	
	// main navigation highlight
			
		var path = window.location.pathname;
			
		var page = path.split('/').pop();
			
		links = $('#main_nav li a');
		
		$.each(links, function() {
			var name = $(this).attr('href');
			if(name === page) {
				$(this).addClass('selected').css('color','#852C01');
			}
		});
		
		//main navigation drop down


		$('#main_nav li').hover(function() {
			$(this).find('.sub-menu').addClass('show');
			},
			function() {
					$(this).find('.sub-menu').removeClass('show');	
			});
		});

})(jQuery);				