<?php 
/*
Template Name: home
*/
?>

<?php get_header(); ?>


  <?php 

	if(isset($options['slider_checkbox'])) {

		$show_slider = $options['slider_checkbox'];

			if (isset($show_slider) && ($show_slider === '1')){

				do_shortcode('[ks_slider]'); 
		
			}
	} 
	?>

		
	<?php
	
	$intro = $options['intro'];
	
	if(!empty($intro)) {
	
	?>
		<div class="intro_bg"><p class="intro"><?php echo $intro; ?></p></div>
		
	<?php } ?>	
	
		<div id="main_content" class="clearfix">
			

			<div id="content_left" class="column">

				<div class="header_bg"><h2>latest News</h2></div>
				
				<?php 
				
				if(isset($options['number_of_posts'])) {
					$posts_per_page = $options['number_of_posts'];
				}
				else {
					$posts_per_page = 2 ;
				}
				
					$args = array(
						'category_name' => 'blog',
						'posts_per_page'=> $posts_per_page
					);
					
					$query = new WP_Query( $args);
				
					if ($query->have_posts() ) : while ($query->have_posts() ) : $query->the_post(); 
				?>

				<div class="front_post clearfix">
					
					<?php $date = get_the_time("U"); ?>
				
					<div class="event_date clearfix">
						<h3><?php echo date('d', $date); ?></h3>
						<h4><?php echo date('M', $date); ?></h4>
					</div><!-- event_date -->
					
				 <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

				  <p>
				    <?php the_excerpt(); ?>
				  </p>
				</div><!--/front_post-->

				<?php endwhile; endif; wp_reset_query(); ?>
				
			</div><!--/content_left-->
	
				<div id="twitter" class="column">
					
					<div class="header_bg"><h2>albums</h2></div>
					
					<div class="small_thumbs clearfix">
					
					<?php global $wp_query; 

						$args = array(
						    'category_name' => 'albums',
						    'post_type' => 'post'
						);

						$query = new WP_Query($args);

						while( $query->have_posts() ) : $query->the_post(); 

					?>
					
				

					<div class="album_small">

					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php
				            	if(has_post_thumbnail()) {
							    the_post_thumbnail('album-thumb');
							}
							?>
					</a>
					</div><!-- album_small -->

					<?php endwhile;	wp_reset_query(); ?>
					
				</div><!-- small_thumbs -->
				
					
				</div><!--twitter-->
				
				<div id="upcoming_events" class="column last">
					
					<div class="header_bg"><h2>upcoming Events</h2></div>
					
					<?php 

						$args = array(
							'post_type' => 'ks_events',
							'posts_per_page'=> $posts_per_page
						);

						$query = new WP_Query( $args);

						if ($query->have_posts() ) : while ($query->have_posts() ) : $query->the_post(); 
					?>

					<div class="event_list clearfix">
						
						<?php 

						$post_id = get_the_ID();
					 	$date = get_post_meta( $post_id, 'ks_events_startdate', true); 

						?>

						<div class="event_date clearfix">
							<h3><?php echo date('d', $date); ?></h3>
							<h4><?php echo date('M', $date); ?></h4>
						</div><!-- event_date -->

					 <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					
					

					  <p>
					    <?php the_excerpt(); ?>
					  </p>
					</div><!-- event_list -->

					<?php endwhile; endif; wp_reset_query(); ?>

				</div><!--/playlist-->

			<div class="clear"></div>
			
	

		</div><!--/main_content-->
		

<?php get_footer(); ?>