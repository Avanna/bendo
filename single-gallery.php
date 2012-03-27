<?php 
/*
Template Name: single-gallery
*/
?>

<?php get_header(); ?>
					
		<div id="page_content" class="clearfix">
			
			
			<div id="inner_wrapper" class="clearfix">
				
				
				<!-- <div id="gallery_nav">
									
									<ul>
										<li><a href="" title="">the tour</a></li>
										<li><a href="#">at home</a></li>
										<li><a href="#">some fans</a></li>
										<li><a href="#">in the studio</a></li>
									</ul>
									
								</div><!--gallery_nav-->
				
				
				<div id="gallery_main">
					
					<div id="gallery_wrapper" class="clearfix">
						
						<h2>Browse our picture and tour gallery</h2>
						
						<?php		
							
						while ( have_posts() ) : the_post(); ?>
							
						<h3><?php the_title(); ?></h3>

						<?php wpo_get_images('thumbnail','0','0','large',"$post->ID",'1','attachment-image','div','small-thumb'); ?>

							
						<?php
							endwhile; wp_reset_query();
						?>
						
					</div><!--/gallery_wrapper-->
					
				</div><!--/gallery_main-->
				
			</div><!--/inner_wrapper-->
		
		</div><!--/page_content-->
		
<?php get_footer(); ?>