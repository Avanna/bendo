<?php

$labels = array(
		'name' => _x('Videos', 'post type general name'),
		'singular_name' => _x('Video', 'post type singular name'),
		'add_new' => _x('Add New', 'Video'),
		'add_new_item' => __("Add New Video"),
		'edit_item' => __("Edit Videos"),
		'new_item' => __("New Videos"),
		'view_item' => __("View Videos"),
		'search_items' => __("Search Videos"),
		'not_found' =>  __('No videos found'),
		'not_found_in_trash' => __('No videos found in Trash'), 
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
	
register_post_type('video', $args);

add_filter('manage_edit-video_columns', 'add_new_video_columns');

function add_new_video_columns($video_columns) {
	//	$new_columns['cb'] = '<input type="checkbox" />';
 
		$new_columns['id'] = __('ID');
		$new_columns['title'] = _x('Video Name', 'column name');
		$new_columns['author'] = __('Author');
 
		$new_columns['categories'] = __('Categories');
		$new_columns['tags'] = __('Tags');
 
		$new_columns['date'] = _x('Date', 'column name');
 
		return $new_columns;
	}
	
// Add to admin_init function
add_action('manage_video_posts_custom_column', 'manage_video_columns', 10, 2);

function manage_video_columns($column_name, $id) {
	global $wpdb;
	switch ($column_name) {
	case 'id':
		echo $id;
	        break;
	default:
		break;
	} // end switch
}

// Adding Custom Meta Information for tracks
add_action('add_meta_boxes', 'video_add_custom_box');
function video_add_custom_box() {
    add_meta_box('video_information', 'Video Information', 'video_id_box', 'video','normal', 'high');
}

function video_id_box() {
	$video_id = '';
    if ( isset($_REQUEST['post']) ) {
        $video_id = get_post_meta((int)$_REQUEST['post'],'video_id',true); 
    }
	$video_site = '';
    if ( isset($_REQUEST['post']) ) {
        $video_site = get_post_meta((int)$_REQUEST['post'],'video_site',true); 
   }

?>

<div id="video_options">
	
	<?php
		wp_nonce_field( 'video_box_nonce', 'meta_box_nonce' ); 
	?>

<div>
<label for="video_id">Video Id</label>
<input id="video_id" class="widefat" name="video_id" value="<?php echo $video_id; ?>" type="text">
</div>

<div>
<label for="video_box_select">Video Site</label>

<?php $selected = isset( $video_site ) ? esc_attr( $video_site ) : ""; ?> 

<select name="video_site" id="video_site">  
      <option value="youtube" <?php selected( $selected, 'youtube' ); ?>>YouTube</option>  
      <option value="vimeo" <?php selected( $selected, 'vimeo' ); ?>>Vimeo</option>  
</select>

</div>

<?php
}

add_action('save_post','video_save_meta');

function video_save_meta($post_id){
	  global $post;
	
		// Bail if we're doing an auto save
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			
			// if our nonce isn't there, or we can't verify it, bail
			if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'video_box_nonce' ) ) {
				return;
			}

			// if our current user can't edit this post, bail
			if( !current_user_can( 'edit_post' ) ) {
				return;
			}
		
		if( isset( $_POST['video_id'] ) ){
	  		update_post_meta($post_id, "video_id", esc_attr($_POST["video_id"]));
		}
		
		if( isset( $_POST['video_site'] ) ){
	  		update_post_meta($post_id, "video_site", esc_attr($_POST["video_site"]));
		}
	}