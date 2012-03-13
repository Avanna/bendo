<?php

function add_myjavascript(){
	wp_enqueue_script( 'jquery-1.7.1', get_bloginfo('template_directory') . "/js/jquery-1.7.1.min.js", array( 'jquery' ) );
	wp_enqueue_script( 'script', get_bloginfo('template_directory') . "/js/script.js", array( 'jquery' ) );
	
	wp_enqueue_script('nivo-slider', (get_bloginfo('template_url')) . '/js/jquery.nivo.slider.pack.js', array('jquery-1.7.1'));
	wp_enqueue_script('ks-slider', (get_bloginfo('template_url')) . '/js/ks-slider.js', array('nivo-slider'));
	
}
  
add_action( 'init', 'add_myjavascript' );



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


?>