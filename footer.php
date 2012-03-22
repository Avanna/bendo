	
		<footer class="clearfix">

			<?php wp_nav_menu(array('menu' => 'footer_nav', 'menu_id' =>'footer_nav')); ?>
			
			<p id="copyright">&#169 Konverge Studios</p>

		</footer>
		
			</div><!-- content  -->
		

	</div><!-- wrapper -->

</div><!-- main wrapper -->




  <!-- Javascript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script>!window.jQuery && document.write('<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.7.1.min.js"><\/script>')</script>

	<!-- Playlist JavaScripts -->
	<script src="<?php bloginfo('template_url'); ?>/playlist/js/jplayer.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/playlist/js/music-player-min.js"></script>
	<script>  
	    $(document).ready(function(){  
	        $('.music-player').ttwMusicPlayer(myPlaylist, {  
	            tracksToShow:3,  
	            description:'Hello, this is a demo description',  
	            jPlayer:{  
	                swfPath: '<?php bloginfo('template_directory'); ?>/playlist/js/',  
	            }  
	        });  
	    });  
	</script>
	
	


  <script src="<?php bloginfo('template_directory'); ?>/js/plugins.js?v=1"></script>
  <script src="<?php bloginfo('template_directory'); ?>/js/script.js?v=1"></script>

  <!--[if lt IE 7 ]>
    <script src="js/dd_belatedpng.js?v=1"></script>
  <![endif]-->


  <!-- yui profiler and profileviewer - remove for production -->
  <script src="<?php bloginfo('template_directory'); ?>/js/profiling/yahoo-profiling.min.js?v=1"></script>
  <script src="<?php bloginfo('template_directory'); ?>/js/profiling/config.js?v=1"></script>
  <!-- end profiling code -->




  <!-- asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet 
       change the UA-XXXXX-X to be your site's ID -->
  <script>
   var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
   (function(d, t) {
    var g = d.createElement(t),
        s = d.getElementsByTagName(t)[0];
    g.async = true;
    g.src = '//www.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g, s);
   })(document, 'script');
  </script>
  
</body>
</html>