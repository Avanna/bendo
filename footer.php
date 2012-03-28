	
		<footer id="footer" class="clearfix">
			
		<div id="footer_column_left" class="column">
				
			<h2>Gallery</h2>
			
			<?php	

				$args = array( 
							'post_type' => 'gallery',
							'posts_per_page' => 1				
						);

				$loop = new WP_Query( $args );

				while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<?php wpo_get_images('tiny-thumb','6','0','large',"$post->ID",'1','attachment-image','div','small-thumb'); ?>

				
					<?php
						endwhile; wp_reset_query();
					?>
		</div><!-- footer_column_left -->
		
		<div id="footer_column_middle" class="column">
			
			<h2>twitter</h2> 

			<?php do_shortcode('[ks_twitter]'); ?>

			<span class="more">read more</span>
			
		</div><!-- footer_colum_middle -->
		
		<div id="footer_column_right" class="column last">
			
			<h2>Some Info</h2> 

			<p id="copyright">&#169 Konverge Studios</p>
			
		</div><!-- footer_colum_right -->
		
		
		
		
		
		
		<div class="clear"></div>

		</footer>
		
		<?php wp_nav_menu(array('menu' => 'footer_nav', 'menu_id' =>'footer_nav')); ?>
		
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
	
	
	


  <script src="<?php bloginfo('template_directory'); ?>/js/plugins.js?v=1"></script>
  <script src="<?php bloginfo('template_directory'); ?>/js/script.js?v=1"></script>

  <!--[if lt IE 7 ]>
    <script src="js/dd_belatedpng.js?v=1"></script>
  <![endif]-->


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
  
<?php wp_footer(); ?>

</body>
</html>