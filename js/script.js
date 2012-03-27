(function ($){

	$(document).ready(function(){
		
		// color scheme options 
		
		console.log(playList['swfPath']);
		
		var headlineColor = colorOptions['headline'];
		var link 		  = colorOptions['link'];
		
		if (colorOptions['colorScheme'] == 1) {
			$('#content h2, #content h2 a, .current-menu-item a').css('color', headlineColor);
			// $('#content a').css('color', link);
		}
		
		$('.directions').click(function (e) {
				$.modal('<iframe src="'+this.href+'&output=embed"></iframe><p class="larger"><a target="_blank" href="'+this.href+'">Get Directions</a></p>',
					{ 
						minWidth : 600,
					  	minHeight: 400
					});
				return false;
			});
		
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

		$('#main_nav li, #footer_nav li').hover(function() {
			
			var width = $(this).width();
			
			console.log('width');
			
			$(this).find('.sub-menu').addClass('show');
			},
			function() {
					$(this).find('.sub-menu').removeClass('show');	
			});
		});
		
		// initialize the music player
		
		$('.music-player').ttwMusicPlayer(myPlaylist, {  
            tracksToShow:3,  
            description:'Hello, this is a demo description',  
            jPlayer:{  
                swfPath: playList['swfPath']  
            }  
        });

})(jQuery);				