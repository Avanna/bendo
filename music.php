<?php 
/*
Template Name: Music
*/
?>

<?php include('header.php'); ?>
		

					
		<div id="page_content" class="clearfix">
			
			<div id="inner_wrapper" class="clearfix">
						
			<div class="padding clearfix">
				
			<div id="album-list" class="cleafix">

				<h2><?php wp_title("",true); ?></h2>
				
				<?php global $wp_query; 

						$args = array(
						    'category_name' => 'albums',
						    'post_type' => 'post'
						);

						$query = new WP_Query($args);



				?>



					<?php while( $query->have_posts() ) : $query->the_post(); 

					?>

				<div class="album-info clearfix">

					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php
			            	if(has_post_thumbnail()) { 
						    the_post_thumbnail('album-thumb', array( 'alt' => get_the_title(),
						    'title' => get_the_title()
						    ));
						}
						?></a>
						
						<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						
						<p><?php the_content(); ?></p>
						
						<h4 class="release_date">Released: 11 dec 2008</h4>

				</div><!-- album info -->

					<?php endwhile; 

						wp_reset_query();

					?>

			</div><!-- #album-list -->
			
			<div id="player-wrapper">
			
				<div class="music-player clearfix">
			
					<h2>Playlist</h2>
			
					<?php include ('playlist/playlist.php' ); ?>
				</div><!-- music player -->
				
			</div><!-- player wrapper -->
				
			</div><!--/padding-->
			
			
			
			</div><!--/inner_wrapper-->
		
		</div><!--/page_content-->
		
<?php include('footer.php'); ?>		