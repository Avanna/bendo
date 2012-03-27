<?php get_header(); ?>
					
			<div id="inner_wrapper" class="clearfix">
				
				<div id="blog_content">
					
					 <?php 
						// global $post;
						
						// $args = array( 'post_type' => 'ks_events');
						// 						$loop = new WP_Query( $args );
					
						if (have_posts() ) : while (have_posts() ) : the_post(); ?>

					 <div class="post clearfix">
						
					<?php the_post_thumbnail(); ?>

					 
					 <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					
					<div class="clear"></div>

					 
					 	<?php // declare time variables
							
							$sd = get_post_meta($post->ID, 'ks_events_startdate', true);
							$ed = get_post_meta($post->ID, 'ks_events_enddate', true);
							$st = date('g:i a', $sd);
							$et = date('g:i a', $ed);
							$state = get_post_meta($post->ID, 'ks_events_state', true);
							$city =  get_post_meta($post->ID, 'ks_events_city', true);
							$address =  get_post_meta($post->ID, 'ks_events_address', true);
							$google_address = $address.' '.$city.' '.$state;
		
						?>
							
							<div class="event_date clearfix">
								<h3><?php echo date('d', $sd); ?></h3>
								<h4><?php echo date('M', $sd); ?></h4>
							</div><!-- event_date -->
							
							<div id="event_time">
								<p>Start time:<strong><?php echo $st; ?></strong></p>
								<p>End time:<strong><?php echo $st; ?></strong></p>
							</div><!-- event_time -->
							
							<div id="event_address">
								
								<p><span class="address"><?php echo $address; ?></span></p>
								
								<?php if($city){?>
								<p><span class="location"><?php echo $city.', '; ?><?php echo $state; ?></span><p>	
								<?php }?>
							
							<p><a class="directions" href="http://maps.google.com/?saddr=<?php echo $google_address?>">Map</a></p>
									
							</div><!--directions-->
							
						<div class="clear"></div>

					  <div class="entry event_entry">
					    <?php the_content(); ?>
					  </div>

					 </div> <!-- post -->

					 <?php endwhile; else: ?>
					 <p>Sorry, no posts matched your criteria.</p>
					 <?php endif; ?>
				
				</div><!--/blog_content-->
				
				<?php get_sidebar(); ?>
				
			</div><!--/inner_wrapper-->

	</div><!--/content-->
	
<?php get_footer(); ?>