<?php 
/*
Template Name: Gallery
*/
?>

<?php include('header.php'); ?>
					
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
							// $monthVal = ($month != 1 ? $month - 1 : 12);
							// 					$yearVal = ($month != 1 ? $year : $year - 1);
							// 			

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
				
			</div><!--/inner_wrapper-->
		
		</div><!--/page_content-->
		
<?php include('footer.php'); ?>