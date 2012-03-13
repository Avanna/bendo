<?php include('header.php'); ?>
					
		<div id="page_content" class="clearfix">
						
			<div id="page_top">
				
			</div><!--/page_top-->
			
			<div id="inner_wrapper" class="clearfix">
				
				<div id="blog_content">
					
					 <?php 
						// global $post;
					
						if (have_posts() ) : while (have_posts() ) : the_post(); ?>

					 <div class="post clearfix">
						
					<?php the_post_thumbnail(); ?>

					 
					 <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

					 
					 <small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>

					  <div class="entry">
					    <?php the_content(); ?>
					  </div>

					  <p class="postmetadata">Posted in <?php the_category(', '); ?></p>
					 </div> <!-- post -->

					 <?php endwhile; else: ?>
					 <p>Sorry, no posts matched your criteria.</p>
					 <?php endif; ?>
				
				</div><!--/blog_content-->
				
				<?php include('sidebar.php'); ?>
				
			</div><!--/inner_wrapper-->
		
		</div><!--/page_content-->
	
<?php include('footer.php'); ?>