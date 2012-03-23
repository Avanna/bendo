<?php

function add_myjavascript(){
	wp_enqueue_script( 'jquery-1.7.1', get_bloginfo('template_directory') . "/js/jquery-1.7.1.min.js");
	
	
	wp_enqueue_script('nivo-slider', (get_bloginfo('template_url')) . '/js/jquery.nivo.slider.pack.js', array('jquery-1.7.1'));
	wp_enqueue_script('ks-slider', (get_bloginfo('template_url')) . '/js/ks-slider.js', array('nivo-slider'));
	
	wp_enqueue_script('mousewheel', (get_bloginfo('template_url')) . '/fancybox/jquery.mousewheel-3.0.4.pack.js', array('jquery-1.7.1'));
	wp_enqueue_script('fancybox', (get_bloginfo('template_url')) . '/fancybox/jquery.fancybox-1.3.4.pack.js', array('jquery-1.7.1'));
	
	wp_enqueue_script('simplemodal', (get_bloginfo('template_url')) . '/js/jquery.simplemodal.1.4.2.min.js', array('jquery-1.7.1'));
	
	wp_enqueue_script( 'script', get_bloginfo('template_directory') . "/js/script.js", array( 'jquery-1.7.1' ) );
	
	
	// retrieve options to localize for use as javascript variables
	$options = get_option('bendo');
	
	$transition = 'fade';
	if(array_key_exists('slider_effects', $options)) {
		$transition = $options['slider_effects'];
	}
	
	$animSpeed = 400;
	if(array_key_exists('slider_speed', $options)) {
		$animSpeed = $options['slider_speed'];
	}
	
	$pauseTime = 3000;
	if(array_key_exists('slider_pause', $options)) {
		$pauseTime = $options['slider_pause'];
	}
	
	$captionOpacity = 0.8;
	if(array_key_exists('caption_opacity', $options)) {
		$captionOpacity = $options['caption_opacity'];
	}
	
	$directionNav = 1;
	if(array_key_exists('slider_navigation', $options)) {
		$directionNav = $options['slider_navigation'];
	}
	
	$directionNavHide = 1;
	if(array_key_exists('hover_arrows', $options)) {
		$directionNavHide = $options['hover_arrows'];
	}
	
	wp_localize_script(
			'script',
			'sliderOptions',
			array(
				'transition' => $transition,
				'animSpeed'  => $animSpeed,
				'pauseTime'  => $pauseTime,
				'opacity'	 => $captionOpacity,
				'directionNav' => $directionNav,
				'directionNavHide' => $directionNavHide
			)
		);
		
	$colorScheme = 0 ;
	if(array_key_exists('color_scheme', $options)) {
		$colorScheme = $options['color_scheme'];
	}
		
	$headlineColor = '#fff';
	if(array_key_exists('headline_color', $options)) {
		$headlineColor = $options['headline_color'];
	}
	
	$linkColor = '#852C01' ;
	if(array_key_exists('link_color', $options)) {
		$linkColor = $options['link_color'];
	}
		
	wp_localize_script(
			'script',
			'colorOptions',
			array(
				'colorScheme' => $colorScheme,
				'headline' => $headlineColor,
				'link' => $linkColor
			)
		);
}


  
add_action( 'init', 'add_myjavascript' );

//add custom admin area stylesheet
add_action('init', 'add_ks_stylesheet');

    /*
     * Enqueue style-file, if it exists.
     */

  function add_ks_stylesheet() {
       wp_enqueue_style( 'ks_admin_styles', (get_bloginfo('template_url')).'/admin/css/ks_admin.css' );
  }


if ( function_exists('register_sidebar') )
    register_sidebar();

add_theme_support('post-thumbnails');
add_image_size('album-thumb', 125, 125, true);
add_image_size('slider-image', 960, 400, true);
add_image_size('album-image', 190, 190, true);

// functions to control post excerpts

function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more($more) {
       global $post;
	return '<br/><a href="'. get_permalink($post->ID) . '">More...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//functions to register custom menus

add_action('init', 'register_custom_menu');
 
function register_custom_menu() {
register_nav_menu('main_nav', __('Main Navigation'));
}

add_action('init', 'register_footer_menu');
 
function register_footer_menu() {
register_nav_menu('footer_nav', __('footer Navigation'));
}

function formatTweet($str){

	// Linkifying URLs, mentionds and topics. Notice that
	// each resultant anchor type has a unique class name.

	$str = preg_replace(
		'/((ftp|https?):\/\/([-\w\.]+)+(:\d+)?(\/([\w\/_\.]*(\?\S+)?)?)?)/i',
		'<a class="link" href="$1" target="_blank">$1</a>',
		$str
	);

	$str = preg_replace(
		'/(\s|^)@([\w\-]+)/',
		'$1<a class="mention" href="http://twitter.com/#!/$2" target="_blank">@$2</a>',
		$str
	);

	$str = preg_replace(
		'/(\s|^)#([\w\-]+)/',
		'$1<a class="hash" href="http://twitter.com/search?q=%23$2">#$2</a>',
		$str
	);

	return $str;
}

// get gallery images

function wpo_get_images($size = 'thumbnail', $limit = '0', $offset = '0', $big = 'large', $post_id = '$post->ID', $link = '1', $img_class = 'gallery-image', $wrapper = 'li', $wrapper_class = 'attachment-image-wrapper') {
	global $post;

	$images = get_children( array('post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

	if ($images) {

		$num_of_images = count($images);

		if ($offset > 0) : $start = $offset--; else : $start = 0; endif;
		if ($limit > 0) : $stop = $limit+$start; else : $stop = $num_of_images; endif; 
		
	?>
		<ul class="clearfix">
	<?php

		$i = 0;
		foreach ($images as $attachment_id => $image) {
			if ($start <= $i and $i < $stop) {
			$img_title = $image->post_title;   // title.
			$img_description = $image->post_content; // description.
			$img_caption = $image->post_excerpt; // caption.
			//$img_page = get_permalink($image->ID); // The link to the attachment page.
			$img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
			if ($img_alt == '') {
			$img_alt = $img_title;
			}
				if ($big == 'large') {
				$big_array = image_downsize( $image->ID, $big );
 				$img_url = $big_array[0]; // large.
				} else {
				$img_url = wp_get_attachment_url($image->ID); // url of the full size image.
				}

			// FIXED to account for non-existant thumb sizes.
			$preview_array = image_downsize( $image->ID, $size );
			if ($preview_array[3] != 'true') {
			$preview_array = image_downsize( $image->ID, 'thumbnail' );
 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.
 			$img_width = $preview_array[1];
 			$img_height = $preview_array[2];
			} else {
 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.
 			$img_width = $preview_array[1];
 			$img_height = $preview_array[2];
 			}
 			// End FIXED to account for non-existant thumb sizes.

 			///////////////////////////////////////////////////////////
			// This is where you'd create your custom image/link/whatever tag using the variables above.
			// This is an example of a basic image tag using this method.
			?>
			<?php if ($wrapper != '0') : ?>	
				
		<li class="gallery-image  <?php echo $wrapper_class; ?>">
				
			<?php endif; ?>
			<?php if ($link == '1') : ?>
			<a class="lightbox" rel="<?php echo $post_id; ?>" href="<?php echo $img_url; ?>" title="<?php echo $img_title; ?>">
			<?php endif; ?>
			<img class="<?php echo $img_class; ?>" src="<?php echo $img_preview; ?>" alt="<?php echo $img_alt; ?>" title="<?php echo $img_title; ?>" />
			<?php if ($link == '1') : ?>
			</a>
			<?php endif; ?>
			<?php if ($img_caption != '') : ?>
			<div class="attachment-caption"><?php echo $img_caption; ?></div>
			<?php endif; ?>
			<?php if ($img_description != '') : ?>
			<div class="attachment-description"><?php echo $img_description; ?></div>
			<?php endif; ?>
			<?php if ($wrapper != '0') : ?>
				
		</li>
			
			<?php endif; ?>
			<?
			// End custom image tag. Do not edit below here.
			///////////////////////////////////////////////////////////

			}
			$i++;
		}
		?>
		</ul>
	<?php
	}
}
?>