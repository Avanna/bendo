<?php 
/*
Template Name: Events
*/
?>

<?php include('header.php'); ?>

		<div id="page_content" class="clearfix dark-bg">
			
			<!-- <div id="page_top">
							
							<h2>events/tours</h2>
						
						</div> --><!--/page_top-->
			
			<div id="inner_wrapper" class="clearfix">
				
				<h2>Upcoming events and tour dates</h2>
				
				<div id="calendar_wrapper">
					
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

						</div><!-- calendar_list -->
						
						

						<?php
							endwhile; wp_reset_query();
						?>
						
						
						
						
								
						
					
				</div><!--/calendar_wrapper-->
				
			</div><!--/inner_wrapper-->
		
		</div><!--/page_content-->	
	
<?php include('footer.php'); ?>