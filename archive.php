<?php 
/*
Template Name: Archives
*/
include('header.php'); ?>
					
	<div id="inner_wrapper" class="clearfix">
				
		<div id="blog_content">
					
			<?php 
					
			if (have_posts() ) : while (have_posts() ) : the_post(); ?>

			<div class="post clearfix">
						
						
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
			<div class="author-info">
				<p>posted by <span><?php the_author(); ?></span></p>
			</div><!-- author info -->
			
				<div class="clear"></div>
						
				<?php $date = get_the_time("U"); ?>

				<div class="header_bg"><h3><?php echo date('M d y', $date); ?></h3></div>
					
					<div class="clear"></div>
					
					  <div class="entry clearfix">
						
						<?php if(has_post_thumbnail()) {?>
						
						<div class="blog_pic_bg clearfix"><?php the_post_thumbnail('album-image'); ?></div>
						
						<?php } ?>
						
					    <?php the_excerpt(); ?>
					  </div>
					
					<footer class="entry-meta">
						<?php $show_sep = false; ?>
						<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
						<?php
							/* translators: used between list items, there is a space after the comma */
							$categories_list = get_the_category_list( __( ', ', 'bendo' ) );
							if ( $categories_list ):
						?>
						<span class="cat-links">
							<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'bendo' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
							$show_sep = true; ?>
						</span>
						<?php endif; // End if categories ?>
						<?php
							/* translators: used between list items, there is a space after the comma */
							$tags_list = get_the_tag_list( '', __( ', ', 'bendo' ) );
							if ( $tags_list ):
							if ( $show_sep ) : ?>
						<span class="sep"> | </span>
							<?php endif; // End if $show_sep ?>
						<span class="tag-links">
							<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'bendo' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
							$show_sep = true; ?>
						</span>
						<?php endif; // End if $tags_list ?>
						<?php endif; // End if 'post' == get_post_type() ?>

						<?php if ( comments_open() ) : ?>
						<?php if ( $show_sep ) : ?>
						<span class="sep"> | </span>
						<?php endif; // End if $show_sep ?>
						<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Comment', 'bendo' ) . '</span>', __( '<b>1</b> Reply', 'bendo' ), __( '<b>%</b> Replies', 'bendo' ) ); ?></span>
						<?php endif; // End if comments_open() ?>

						<?php edit_post_link( __( 'Edit', 'bendo' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- #entry-meta -->
					
					 </div> <!-- post -->

					 <?php endwhile; else: 
						
						wp_reset_query();
					
					?>
					 <p>Sorry, no posts matched your criteria.</p>
					 <?php endif; ?>
					
						<h3><?php next_posts_link('Older Entries »', 0); ?></h3>
						<h3><?php previous_posts_link('Newer Entries »', 0);?></h3>
				
				</div><!--/blog_content-->
				
				<?php get_sidebar(); ?>
				
			</div><!--/inner_wrapper-->	
	
<?php get_footer(); ?>