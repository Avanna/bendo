<?php 
/*
Template Name: Events
*/
?>

<?php get_header(); ?>
			
			<div id="inner_wrapper" class="clearfix">
				
				<div id="calendar_wrapper">
						
					<div class="header_bg"><h2><?php wp_title("",true); ?></h2></div>
				
					
				<?php		
					// $monthVal = ($month != 1 ? $month - 1 : 12);
					// 					$yearVal = ($month != 1 ? $year : $year - 1);
					// 			
					
					$current_month = strtotime('today');		
						
					$args = array( 'post_type' => 'ks_events', 
							'meta_key' => 'ks_events_enddate', 
							'meta_value' => $current_month, 
							'meta_compare' => '>=',
							'type' => 'date',
							'orderby' => 'meta_value_num',
							'order' => 'ASC' 
							);
							
					$loop = new WP_Query( $args );
					
					while ( $loop->have_posts() ) : $loop->the_post(); ?>

						<div class="calendar_list clearfix">
							
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

							<?php if ( has_post_thumbnail() ) {
							  the_post_thumbnail('album-thumb');
							}?>
							
							<div class="event-info">

							<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							
							<p><?php echo date('l', $sd); ?>, <span><?php echo $st; ?></span></p>
							
							<p><?php echo the_excerpt(); ?></p>	
						
							
							
							</div><!-- eventinfo -->
							
							<div id="directions">
								
								<p><span class="address"><?php echo $address; ?></span></p>
								
								<?php if($city){?>
								<p><span class="location"><?php echo $city.', '; ?><?php echo $state; ?></span><p>	
								<?php }?>
							
							<p><a class="directions" href="http://maps.google.com/?saddr=<?php echo $google_address?>">Map</a></p>
									
							</div><!--directions-->
							

						</div><!-- calendar_list -->
						
						

						<?php
							endwhile; wp_reset_query();
						?>
						
						
						
						
								
						
					
				</div><!--/calendar_wrapper-->
				
			</div><!--/inner_wrapper-->
	
<?php get_footer(); ?>