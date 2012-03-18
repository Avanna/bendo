<?php 
/*
Template Name: home
*/
?>

<?php include('header.php'); ?>
  
<?php do_shortcode('[ks_slider]'); ?>

		<div id="main_content" class="clearfix">

			<div id="content_left" class="column">

				<h2>latest from the blog</h2>
				
				<?php 
				
					$args = array(
						'category_name' => 'blog',
						'posts_per_page'=> 2
					);
					
					$query = new WP_Query( $args);
				
					if ($query->have_posts() ) : while ($query->have_posts() ) : $query->the_post(); 
				?>

				<div class="front_post">
				 
				 <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

				 
				 <small><?php the_time('F jS, Y') ?></small>

				  <p>
				    <?php the_excerpt(); ?>
				  </p>
				</div><!--/front_post-->

				<?php endwhile; endif; wp_reset_query(); ?>
				
			</div><!--/content_left-->

				<div id="playlist" class="column">
					
					<h2>upcoming Events/Tours</h2>
					
					<?php 

						$args = array(
							'post_type' => 'ks_events',
							'posts_per_page'=> 2
						);

						$query = new WP_Query( $args);

						if ($query->have_posts() ) : while ($query->have_posts() ) : $query->the_post(); 
					?>

					<div class="event_list clearfix">

					 <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					
					<?php 
					
					$post_id = get_the_ID();
				 	$date = date('M d Y' , get_post_meta( $post_id, 'ks_events_startdate', true )); 
					
					?>
			
					<small><?php echo $date; ?></small>

					  <p>
					    <?php the_excerpt(); ?>
					  </p>
					</div><!-- event_list -->

					<?php endwhile; endif; wp_reset_query(); ?>

				</div><!--/playlist-->
				
				<div id="twitter" class="column last">

					<h2>twitter feed</h2>
					
						<?php do_shortcode('[ks_twitter username="justpatie"]'); ?>

					<span class="more">read more</span>

				</div><!--twitter-->

			<div class="clear"></div>
			
			<div id="latest_releases" class="clearfix">
				
			<h2>some albums</h2>

			<?php global $wp_query; 

					$args = array(
					    'category_name' => 'albums',
					    'post_type' => 'post'
					);

					$query = new WP_Query($args);



			?>

		 	

				<?php while( $query->have_posts() ) : $query->the_post(); 
				
				?>
				
			<div class="album clearfix">
				
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php
		            	if(has_post_thumbnail()) {
					    the_post_thumbnail('album-image', array( 'alt' => get_the_title(),
					    'title' => get_the_title()
					    ));
					}
					?>
			</a>

			</div>
				
				<?php endwhile; 

					wp_reset_query();

				?>


		</div><!--/latest_releases-->

		</div><!--/main_content-->
		

<?php include('footer.php'); ?>