<?php


function ks_slider ( $atts ) {
	
extract( shortcode_atts( array(
	        'address' => '',
	            ), $atts ) );
	
ob_start();

?>

<div id="slider-wrapper theme-default">
	
	<?php global $wp_query; 
			
			$args = array(
			    'category_name' => 'slider',
			    'post_type' => 'post'
			);
			
			$query = new WP_Query($args);
			
			
			
	?>
	
 	<div id="slider" class="nivoSlider">
	
		<?php while( $query->have_posts() ) : $query->the_post(); 
            	if(has_post_thumbnail()) {
			    the_post_thumbnail('slider-image', array( 'alt' => get_the_title(),
			    'title' => get_the_title()
			    ));
			}
			?>
        

			<?php endwhile; 
			
				wp_reset_query();
			
			?>
	</div>
			
</div><!-- slider wrapper -->

<?php

$slider = ob_get_contents();
return $slider;
ob_end_clean();
}

add_shortcode( 'ks_slider', 'ks_slider' );
?>