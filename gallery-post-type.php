<?php

$labels = array(
		'name' => _x('Galleries', 'post type general name'),
		'singular_name' => _x('Gallery', 'post type singular name'),
		'add_new' => _x('Add New', 'gallery'),
		'add_new_item' => __("Add New Gallery"),
		'edit_item' => __("Edit Gallery"),
		'new_item' => __("New Gallery"),
		'view_item' => __("View Gallery"),
		'search_items' => __("Search Gallery"),
		'not_found' =>  __('No galleries found'),
		'not_found_in_trash' => __('No galleries found in Trash'), 
		'parent_item_colon' => ''
	  );
	
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail','editor')
	  ); 
	
register_post_type('gallery',$args);

add_filter('manage_edit-gallery_columns', 'add_new_gallery_columns');

function add_new_gallery_columns($gallery_columns) {
		$new_columns['cb'] = '<input type="checkbox" />';
 
		$new_columns['id'] = __('ID');
		$new_columns['title'] = _x('Gallery Name', 'column name');
		$new_columns['images'] = __('Images');
		$new_columns['author'] = __('Author');
 
		$new_columns['categories'] = __('Categories');
		$new_columns['tags'] = __('Tags');
 
		$new_columns['date'] = _x('Date', 'column name');
 
		return $new_columns;
	}
	
// Add to admin_init function
add_action('manage_gallery_posts_custom_column', 'manage_gallery_columns', 10, 2);

function manage_gallery_columns($column_name, $id) {
	global $wpdb;
	switch ($column_name) {
	case 'id':
		echo $id;
	        break;

	case 'images':
		// Get number of images in gallery
		$num_images = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->posts WHERE post_parent = {$id};"));
		echo $num_images; 
		break;
	default:
		break;
	} // end switch
}