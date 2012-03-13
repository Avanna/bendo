(function ($){

	$(document).ready(function(){
	
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