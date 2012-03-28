<?php 
/*
Template Name: Bio
*/
?>

<?php include('header.php'); ?>
	
	<div id="inner_wrapper" class="clearfix">
					
		<div class="bio-wrapper">
					
			<div id="group-bio" >

						<?php
							while ( have_posts() ) : the_post(); ?>
							
							<div class="header_bg"><h2>The Group</h2></div>

							<div class="album_small"><?php if ( has_post_thumbnail() ) {
							  the_post_thumbnail('medium');
							}?>
							</div><!-- album small -->

							<h3><?php echo	the_title();?></h3>

							<p><?php echo the_content(); ?></p>
							
								<div class="fb-like-box" data-href="http://www.facebook.com/platform" data-width="340" data-show-faces="true" data-stream="false" data-header="false"></div>

						<?php
							endwhile;
						?>
						
					
					
			</div><!-- group-bio -->
					
			<div id ="individual-bio">
						
					<?php $args = array( 'post_type' => 'Members', 'posts_per_page' => 5 );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
					
					<div class="member-bio">
							
						<?php if ( has_post_thumbnail() ) {
						  the_post_thumbnail('album-thumb');
						}?>
						
						<div class="header_bg"><h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3></div>
						
						<h4><?php echo get_post_meta($post->ID, 'member_position', true); ?></h4>
							
						<p><?php echo the_excerpt(); ?></p>
						
					</div><!-- member-bio-->
					
					<?php
						endwhile; wp_reset_query();
					?>
						

			</div><!-- individual bio -->
					
		</div><!-- bio wrapper -->
					
	</div><!--/inner_wrapper-->

<?php get_footer(); ?>