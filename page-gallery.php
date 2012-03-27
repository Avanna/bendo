<?php 
/*
Template Name: Gallery
*/
?>

<?php include('header.php'); ?>
	
			<div id="inner_wrapper" class="clearfix">				
				
				<div id="gallery_main">
					
					<div id="gallery_wrapper" class="clearfix">
						
						<div class="header_bg"><h2><?php wp_title("",true); ?></h2></div>
						
						<?php		

							$current_month = strtotime('today');		

							$args = array( 'post_type' => 'gallery'
								
									);

							$loop = new WP_Query( $args );

							while ( $loop->have_posts() ) : $loop->the_post(); ?>
							
							<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

								<?php wpo_get_images('thumbnail','0','0','large',"$post->ID",'1','attachment-image','div','small-thumb'); ?>

							
								<?php
									endwhile; wp_reset_query();
								?>
						
					</div><!--/gallery_wrapper-->
					
				</div><!--/gallery_main-->
				
				
				
				<?php
					if($options['gallery_sidebar'] == 1) {
				
							get_sidebar(); 
							
					} ?>
				
			</div><!--/inner_wrapper-->
		
<?php get_footer(); ?>