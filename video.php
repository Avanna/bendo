<?php 
/*
Template Name: Video
*/
?>

<?php include('header.php'); ?>

			<div id="inner_wrapper" class="clearfix">
						
			<div class="padding clearfix">
				
			<div id="album-list" class="cleafix">

				<h2><?php wp_title("",true); ?></h2>
				
				<?php global $wp_query; 

						$args = array(
						    'post_per_page' => 10,
						    'post_type' => 'video'
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
						
						<?php  
						$videosite = get_post_meta($post->ID, 'video_site', true);  
						$videoid = get_post_meta($post->ID, "video_id", true); 
						
						if ($videosite == 'vimeo')  
						{  
						    echo '<iframe src="http://player.vimeo.com/video/'.$videoid.'" width="500" height="316" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';  
						}  
						else if ($videosite == 'youtube')  
						{  
						    echo '<iframe width="500" height="316" src="http://www.youtube.com/embed/'.$videoid.'" frameborder="0" allowfullscreen></iframe>';  
						}  
						else  
						{  
						    echo 'Please select a Video Site via the WordPress Admin';  
						} 
						?>
						
						<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						
						<p><?php the_content(); ?></p>
						
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
		
<?php get_footer(); ?>		
