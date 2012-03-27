<ul id="sidebar">
	
	<div class="small_thumbs clearfix">
		
	<h3>Our Music</h3>
	
	<?php global $wp_query; 

		$args = array(
		    'category_name' => 'albums',
		    'post_type' => 'post',
			'limit'     => 4
		);

		$query = new WP_Query($args);

		while( $query->have_posts() ) : $query->the_post(); 

	?>
	


	<div class="album_small">

	<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php
            	if(has_post_thumbnail()) {
			    the_post_thumbnail('tiny-thumb');
			}
			?>
	</a>
	</div><!-- album_small -->

	<?php endwhile;	wp_reset_query(); ?>
	
</div><!-- small_thumbs -->

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
 <li id="about">
  <h2>About</h2>
  <p>This is my blog.</p>
 </li>
 <li id="links">
  <h2>Links</h2>
  <ul>
   <li><a href="http://example.com">Example</a></li>
  </ul>
 </li>
<?php endif; ?>


</ul>