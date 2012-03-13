<?php
// Adding Custom Post Type
add_action('init', 'playlist_register');
function playlist_register() {
	$labels = array(
		'name'				=> _x('Playlist','Music Player','Music Player'),
		'singular_name'		=> _x('Music Player','Music Player', 'Music Player'),
		'add_new'			=> _x('Add New Track', 'Music Listing','Music'),
		'add_new_item'		=> __('Add New Track','Music'),
		'edit_item'			=> __('Edit Track','Music'),
		'new_item'			=> __('New Music Post Item','Music'),
		'view_item'			=> __('View Music Item','Music'),
		'search_items'		=> __('Search Music Items','Music'),
		'not_found'			=> __('Nothing found','Music'),
		'not_found_in_trash'=> __('Nothing found in Trash','Music'),
		'parent_item_colon'	=> ''
	);
 
	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'exclude_from_search'=> false,
		'show_ui'			=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'rewrite'			=> array( 'with_front' => false ),
		'query_var'			=> false,	
		'menu_icon'			=> get_stylesheet_directory_uri() . '/playlist/images/playlist.png',  		
		'supports'			=> array('title', 'editor', 'thumbnail'),
	); 
	register_post_type( 'playlist' , $args );
}

//Custom Overview Page
add_action("manage_posts_custom_column", "music_custom_columns");
add_filter("manage_edit-playlist_columns", "my_areas_columns");
function my_areas_columns($columns) 
{
	$columns = array(
		"thumbnail" => "Album Cover",
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Track Title",
		"artist" => "Artist Name"	
	);
	return $columns;
}
 
function music_custom_columns($column)
{
	global $post;
	if ("ID" == $column) echo $post->ID;
	elseif ("artist" == $column) 
		echo get_post_meta(get_the_ID(),'music_artist',true); 
	elseif ("thumbnail" == $column) the_post_thumbnail('album-thumb');
}



// Adding Custom Meta Information for tracks
add_action('add_meta_boxes', 'music_add_custom_box');
function music_add_custom_box() {
    add_meta_box('track_info', 'Track Information', 'track_box', 'playlist','normal', 'high');
}

function track_box() {
	$music_mp3 = '';
    if ( isset($_REQUEST['post']) ) {
        $music_mp3 = get_post_meta((int)$_REQUEST['post'],'music_mp3',true); 
    }
	$music_ogg = '';
    if ( isset($_REQUEST['post']) ) {
        $music_ogg = get_post_meta((int)$_REQUEST['post'],'music_ogg',true); 
    }
	$music_artist = '';
    if ( isset($_REQUEST['post']) ) {
        $music_artist = get_post_meta((int)$_REQUEST['post'],'music_artist',true); 
    }
	$music_buy = '';
    if ( isset($_REQUEST['post']) ) {
        $music_buy = get_post_meta((int)$_REQUEST['post'],'music_buy',true); 
    }
	$music_price = '';
    if ( isset($_REQUEST['post']) ) {
        $music_price = get_post_meta((int)$_REQUEST['post'],'music_price',true); 
    }
	$music_duration = '';
    if ( isset($_REQUEST['post']) ) {
        $music_duration = get_post_meta((int)$_REQUEST['post'],'music_duration',true); 
    }
?>

<div id="track_list">

<div>
<label for="music_mp3">MP3</label>
<input id="music_mp3" class="widefat" name="music_mp3" value="<?php echo $music_mp3; ?>" type="text">
</div>

<div>
<label for="music_ogg">OGG</label>
<input id="music_ogg" class="widefat" name="music_ogg" value="<?php echo $music_ogg; ?>" type="text">
<p style="padding-left:140px;"><a href="http://media.io/" target="_blank">Convert your music files online here</a> then use Upload/Insert <img src="images/media-button-music.gif" /></p>
</div>

<div>
<label for="music_artist">Artist</label>
<input id="music_artist" class="widefat" name="music_artist" value="<?php echo $music_artist; ?>" type="text">
</div>

<div>
<label for="music_buy">URL To Purchase</label>
<input id="music_buy" class="widefat" name="music_buy" value="<?php echo $music_buy; ?>" type="text">
</div>

<div>
<label for="music_price">Song Price</label>
<input id="music_price" class="widefat" name="music_price" value="<?php echo $music_price; ?>" type="text">
</div>

<div>
<label for="music_duration">Song Duration</label>
<input id="music_duration" class="widefat" name="music_duration" value="<?php echo $music_duration; ?>" type="text">
</div>

</div>

<?php
}
add_action('save_post','catalog_save_meta');
function catalog_save_meta($postID) {
    if ( is_admin() ) {
        if ( isset($_POST['music_mp3']) ) {
            update_post_meta($postID,'music_mp3',
                                $_POST['music_mp3']);
        }
		 if ( isset($_POST['music_ogg']) ) {
            update_post_meta($postID,'music_ogg',
                                $_POST['music_ogg']);
        }
		if ( isset($_POST['music_artist']) ) {
            update_post_meta($postID,'music_artist',
                                $_POST['music_artist']);
        }
		 if ( isset($_POST['music_buy']) ) {
            update_post_meta($postID,'music_buy',
                                $_POST['music_buy']);
        }
		 if ( isset($_POST['music_price']) ) {
            update_post_meta($postID,'music_price',
                                $_POST['music_price']);
        }
		if ( isset($_POST['music_duration']) ) {
            update_post_meta($postID,'music_duration', $_POST['music_duration']);
        }
		
    }
}

register_taxonomy("albums", array("playlist"), array("label" => "Albums", "singular_label" => "Albums", "rewrite" => true)); 
?>