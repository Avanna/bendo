<?php include('header.php'); ?>
					
		<div id="page_content" class="clearfix">
						
			<div id="page_top">
				
			</div><!--/page_top-->
			
			<div id="inner_wrapper" class="clearfix">
				
				<div id="blog_content">
					
					 <?php 
					
						$args = array(
							'category_name' => 'blog'
						);
						
						$query = new WP_Query( $args);
					
						if ($query->have_posts() ) : while ($query->have_posts() ) : $query->the_post(); ?>

					 <div class="post clearfix">
						
					<?php the_post_thumbnail(); ?>

					 
					 <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

					 
					 <small><?php the_time('F jS, Y') ?></small>

					  <div class="entry">
					    <?php the_content(); ?>
					  </div>

					  <p class="postmetadata">Posted in <?php the_category(', '); ?></p>
					 </div> <!-- post -->

					 <?php endwhile; else: 
						
						wp_reset_query();
					
					?>
					 <p>Sorry, no posts matched your criteria.</p>
					 <?php endif; ?>
					
						<h3><?php next_posts_link('Older Entries »', 0); ?></h3>
						<h3><?php previous_posts_link('Newer Entries »', 0);?></h3>
				
				</div><!--/blog_content-->
				
				<?php include('sidebar.php'); ?>
				
			</div><!--/inner_wrapper-->
		
		</div><!--/page_content-->
		
	
<?php include('footer.php'); ?>