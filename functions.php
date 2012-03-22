<?php

require_once('twitter-feed.php');
require_once('slider_code.php');
require_once('custom_functions.php');
require_once('gallery-post-type.php');
require_once('video-post-type.php');


/* 
 * Loads the Options Panel
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {

	/* Set the file path based on whether we're in a child theme or parent theme */

	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/admin/');
	}

	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

//require_once('calendar/json-feed.php');

function load_themeforce_js() {
 
// ... my other scripts...
 
// - fullcalendar -
wp_enqueue_script('jquery-1.7.1', (get_bloginfo('template_url')) . '/js/jquery-1.7.1.min.js');
wp_enqueue_script('fullcalendar', (get_bloginfo('template_url')) . '/js/fullcalendar.min.js', array('jquery-1.7.1'));

 
// - set path to json feed -
$jsonevents = get_bloginfo('template_url') . '/calendar/json-feed.php';
 
// - tell JS to use this variable instead of a static value -
wp_localize_script( 'fullcalendar', 'themeforce', array(
    'events' => $jsonevents,
    ));
}
 
add_action('wp_print_scripts', 'load_themeforce_js');

// add javascript file for events 


function ks_events_init() {
 	global $wp_query;
 
 	// Add code to index pages.
 
	wp_enqueue_script( 'ks-events', get_bloginfo('template_directory') . "/js/ks-events.js", array('jquery','fullcalendar'));

	$max = $wp_query->max_num_pages;
	$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

	// Add some parameters for the JS.
	wp_localize_script(
		'ks-events',
		'cal_obj',
		array (
			'startPage' => $paged,
			'maxPages' => $max,
			'nextLink' => next_posts($max, false),
			'ajaxurl' => admin_url('admin-ajax.php')
			
		) 
	);
	
	
}

add_action('admin_enqueue_scripts', 'ks_events_init');

function ks_events_ajax() {
	$today6am = strtotime('today 6:00') + ( get_option( 'gmt_offset' ) * 3600 );

	// - query -
	global $wpdb;
	$querystr = "
	    SELECT *
	    FROM $wpdb->posts wposts, $wpdb->postmeta metastart, $wpdb->postmeta metaend
	    WHERE (wposts.ID = metastart.post_id AND wposts.ID = metaend.post_id)
	    AND (metaend.meta_key = 'tf_events_enddate' AND metaend.meta_value > $today6am )
	    AND metastart.meta_key = 'tf_events_enddate'
	    AND wposts.post_type = 'tf_events'
	    AND wposts.post_status = 'publish'
	    ORDER BY metastart.meta_value ASC LIMIT 500
	 ";

	$events = $wpdb->get_results($querystr, OBJECT);
	$jsonevents = array();

	// - loop -
	if ($events):
	global $post;
	foreach ($events as $post):
	setup_postdata($post);

	// - custom post type variables -
	$custom = get_post_custom(get_the_ID());
	$sd = $custom["tf_events_startdate"][0];
	$ed = $custom["tf_events_enddate"][0];

	// - grab gmt for start -
	$gmts = date('Y-m-d H:i:s', $sd);
	$gmts = get_gmt_from_date($gmts); // this function requires Y-m-d H:i:s
	$gmts = strtotime($gmts);

	// - grab gmt for end -
	$gmte = date('Y-m-d H:i:s', $ed);
	$gmte = get_gmt_from_date($gmte); // this function requires Y-m-d H:i:s
	$gmte = strtotime($gmte);

	// - set to ISO 8601 date format -
	$stime = date('c', $gmts);
	$etime = date('c', $gmte);

	// - json items -
	$jsonevents[] = array(
	    'title' => $post->post_title,
	    'allDay' => false, // <- true by default with FullCalendar
	    'start' => $stime,
	    'end' => $etime,
	    'url' => get_permalink($post->ID)
	    );

	endforeach;
	else :
	endif;

	// - fire away -
	
	echo json_encode($jsonevents);
	die();
}
add_action( 'wp_ajax_nopriv_ks_events_ajax', 'ks_events_ajax' );  
add_action( 'wp_ajax_ks_events_ajax', 'ks_events_ajax'  );





define('OD_THEME_OPTIONS', TEMPLATEPATH . '/settings/');    // Theme Options Directory  
  
require_once( OD_THEME_OPTIONS . '/settings.php' ); // Get Settings

// this includes the code for the playlist post type

include('playlist-post-type.php');
// add widgetized sidebar

add_action('init', 'add_bio_post_type'); 
 
function add_bio_post_type() {  
        $labels = array(  
        'name'                  => _x('All Members','Music Player','Music Player'),  
        'singular_name'     => _x('Member','Member'),  
        'add_new'               => _x('Add New', 'Member'),  
        'add_new_item'          => __('Add New Member'),  
        'edit_item'         => __('Edit Member Info'),  
        'new_item'              => __('New Member Info'),  
        'view_item'         => __('View Member Info'),  
        'search_items'          => __('Search Members'),  
        'not_found'         => __('Nothing found','Members'),  
        'not_found_in_trash'    => __('Nothing found in Trash','Members'),  
        'parent_item_colon' => ''  
        );  
  
        $args = array(  
        'labels'                => $labels,  
        'public'                => true,  
        'exclude_from_search'   => false,  
        'show_ui'               => true,  
        'capability_type'       => 'post',  
        'hierarchical'          => false,  
        'rewrite'               => array( 'with_front' => false ),  
        'query_var'         => false,  
        'supports'              => array('title', 'editor', 'thumbnail'),  
        );  
        register_post_type( 'Members' , $args );  
        }

add_action("manage_posts_custom_column",  "members_custom_columns");
add_filter("manage_edit-members_columns", "member_columns");

	function member_columns($columns)  
	{  
		$columns = array(  
	  	   "title" => "Name",   
		   "description"     => "bio",  
		   "thumbnail"    => "thumbnail",
			"member_position" => "position"
		);  
	 return $columns;  
	}  
	
	
	function members_custom_columns($column)  
	{  
	   	global $post;

		  switch ($column) {
		    case "description":
		      the_excerpt();
		      break;
		
			case "thumbnail":
		      the_post_thumbnail();
		      break;
		
		    case "member_position":
		      $custom = get_post_custom();
		      echo $custom["member_position"][0];
		      break;
		  } 
	}
	
add_action("add_meta_boxes", "add_members_meta_boxes");

	function add_members_meta_boxes(){
	  add_meta_box("member_position_meta", "Member Position", "member_position", "members", "normal", "low");
	}

	function member_position(){
	  global $post;
	  $custom = get_post_custom($post->ID);
	
	 if(isset($custom["member_position"])) {
	  $member_position = $custom["member_position"][0];
	}
	
	
	  ?>
	  <label>Member Position</label>
	  <input name="member_position" value="<?php echo (isset($member_position)) ?  $member_position : ''; ?>" />
	  <?php
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' ); 
	}
	
	//save our custom post type fields
	
	add_action('save_post', 'save_member_position');
	
function save_member_position($post_id){
	  global $post;
	
		// Bail if we're doing an auto save
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			
			// if our nonce isn't there, or we can't verify it, bail
			if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) {
				return;
			}

			// if our current user can't edit this post, bail
			if( !current_user_can( 'edit_post' ) ) {
				return;
			}
		
	
		
		if( isset( $_POST['member_position'] ) ){
	  		update_post_meta($post_id, "member_position", esc_attr($_POST["member_position"]));
		}
	}
	
// code for event calendar

add_action( 'init', 'add_event_postype' );
 
function add_event_postype() {
 
$labels = array(
    'name' => _x('Events', 'post type general name'),
    'singular_name' => _x('Event', 'post type singular name'),
    'add_new' => _x('Add New', 'events'),
    'add_new_item' => __('Add New Event'),
    'edit_item' => __('Edit Event'),
    'new_item' => __('New Event'),
    'view_item' => __('View Event'),
    'search_items' => __('Search Events'),
    'not_found' =>  __('No events found'),
    'not_found_in_trash' => __('No events found in Trash'),
    'parent_item_colon' => '',
);
 
$args = array(
    'label' => __('Events'),
    'labels' => $labels,
    'public' => true,
    'can_export' => true,
    'show_ui' => true,
    '_builtin' => false,
    'capability_type' => 'post',
    // 'menu_icon' => get_bloginfo('template_url').'/functions/images/event_16.png',
    'hierarchical' => false,
    'rewrite' => array( "slug" => "event"), 
    'supports'=> array('title', 'thumbnail', 'excerpt', 'editor') ,
    'show_in_nav_menus' => true,
    'taxonomies' => array( 'ks_eventcategory', 'post_tag')
);
 
register_post_type( 'ks_events', $args);
 
}	

function add_eventcategory_taxonomy() {
 
$labels = array(
    'name' => _x( 'Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Categories' ),
    'popular_items' => __( 'Popular Categories' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Category' ),
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
    'separate_items_with_commas' => __( 'Separate categories with commas' ),
    'add_or_remove_items' => __( 'Add or remove categories' ),
    'choose_from_most_used' => __( 'Choose from the most used categories' ),
);
 
register_taxonomy('ks_eventcategory','ks_events', array(
    'label' => __('Event Category'),
    'labels' => $labels,
    'hierarchical' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'event-category' ),
));
}
 
add_action( 'init', 'add_eventcategory_taxonomy', 0 );	
	
// 3. Show Columns
 
add_filter ("manage_edit-ks_events_columns", "ks_events_edit_columns");
add_action ("manage_posts_custom_column", "ks_events_custom_columns");
 
function ks_events_edit_columns($columns) {
 
$columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "ks_col_ev_cat" => "Category",
    "ks_col_ev_date" => "Dates",
    "ks_col_ev_times" => "Times",
    "ks_col_ev_thumb" => "Thumbnail",
    "title" => "Event",
    "ks_col_ev_desc" => "Description",
    );
return $columns;
}
 
function ks_events_custom_columns($column)
{
global $post;
$custom = get_post_custom();
switch ($column)
{
case "ks_col_ev_cat":
    // - show taxonomy terms -
    $eventcats = get_the_terms($post->ID, "ks_eventcategory");
    $eventcats_html = array();
    if ($eventcats) {
    foreach ($eventcats as $eventcat)
    array_push($eventcats_html, $eventcat->name);
    echo implode($eventcats_html, ", ");
    } else {
    _e('None', 'themeforce');;
    }
break;
case "ks_col_ev_date":
    // - show dates -
    $startd = $custom["ks_events_startdate"][0];
    $endd = $custom["ks_events_enddate"][0];
    $startdate = date("F j, Y", $startd);
    $enddate = date("F j, Y", $endd);
    echo $startdate . '<br /><em>' . $enddate . '</em>';
break;
case "ks_col_ev_times":
    // - show times -
    $startt = $custom["ks_events_startdate"][0];
    $endt = $custom["ks_events_enddate"][0];
    $time_format = get_option('time_format');
    $starttime = date($time_format, $startt);
    $endtime = date($time_format, $endt);
    echo $starttime . ' - ' .$endtime;
break;
case "ks_col_ev_thumb":
    // - show thumb -
    $post_image_id = get_post_thumbnail_id(get_the_ID());
    if ($post_image_id) {
    $thumbnail = wp_get_attachment_image_src( $post_image_id, 'post-thumbnail', false);
    if ($thumbnail) (string)$thumbnail = $thumbnail[0];
    echo '<img src="';
    echo bloginfo('template_url');
    echo '/timthumb/timthumb.php?src=';
    echo $thumbnail;
    echo '&h=60&w=60&zc=1" alt="" />';
}
break;
case "ks_col_ev_desc";
    the_excerpt();
break;
 
}
}	

//  Show Meta-Box
 
add_action( 'admin_menu', 'ks_events_create' );
 
function ks_events_create() {
    add_meta_box('ks_events_meta', 'Events', 'ks_events_meta', 'ks_events');
}
 
function ks_events_meta () {
 
// - grab data -
 
global $post;
$custom = get_post_custom($post->ID);

	if(isset($custom["ks_events_startdate"])) {
		$meta_sd = $custom["ks_events_startdate"][0];
		$meta_st = $meta_sd;
	}
	
	else {
		$meta_sd = null;
	}
	
	if(isset($custom["ks_events_enddate"])) {
		$meta_ed = $custom["ks_events_enddate"][0];
		$meta_et = $meta_ed;
	}

// - grab wp time format -
 
$date_format = get_option('date_format'); // Not required in my code
$time_format = get_option('time_format');
 
// - populate today if empty, 00:00 for time -
 
if ($meta_sd == null) { $meta_sd = time(); $meta_ed = $meta_sd; $meta_st = 0; $meta_et = 0;}
 
// - convert to pretty formats -
 
$clean_sd = date("D, M d, Y", $meta_sd);
$clean_ed = date("D, M d, Y", $meta_ed);
$clean_st = date($time_format, $meta_st);
$clean_et = date($time_format, $meta_et);
 
// - security -
 
$ks_events_state = '';
if(isset($custom["ks_events_state"])) {
	$ks_events_state = $custom["ks_events_state"][0];
}

$ks_events_city = '';
if(isset($custom["ks_events_city"])) {
	$ks_events_city = $custom["ks_events_city"][0];
}

$ks_events_address = '';
if(isset($custom["ks_events_address"])) {
	$ks_events_address = $custom["ks_events_address"][0];
}
 
// - output -
 
?>
<div class="ks-meta">

<ul>
	<?php wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' ); ?>
	
	<li><label>State</label><br/><input type="text" name="ks_events_state" value="<?php echo $ks_events_state; ?>" /></li>
	
	<li><label>City</label><br/><input type="text" name="ks_events_city" value="<?php echo $ks_events_city; ?>" /></li>
	
	<li><label>Address</label><br/><input type="text" name="ks_events_address" value="<?php echo $ks_events_address; ?>" /></li>
	
    <li><label>Start Date</label><br/><input type="text" name="ks_events_startdate" class="ksdate" value="<?php echo $clean_sd; ?>" /></li>
	
    <li><label>Start Time</label><br/><input type="text" name="ks_events_starttime" value="<?php echo $clean_st; ?>" /><em>Use 24h format (7pm = 19:00)</em></li>
    <li><label>End Date</label><br/><input type="text" name="ks_events_enddate" class="ksdate" value="<?php echo $clean_ed; ?>" /></li>
    <li><label>End Time</label><br/><input type="text" name="ks_events_endtime" value="<?php echo $clean_et; ?>" /><em>Use 24h format (7pm = 19:00)</em></li>
</ul>

</div>

<?php

}

// Save  Events Data
 
add_action ('save_post', 'save_ks_events');
 
function save_ks_events($post_id){
 
global $post;

// verify nonce
    // Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		
		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) {
			return;
		}

		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post' ) ) {
			return;
		}
 
// - convert back to unix & update post
 
if(!isset($_POST["ks_events_startdate"])):
return $post;
endif;
$updatestartd = strtotime ( $_POST["ks_events_startdate"] . $_POST["ks_events_starttime"] );
update_post_meta($post_id, "ks_events_startdate", $updatestartd );
 
if(!isset($_POST["ks_events_enddate"])):
return $post;
endif;
$updateendd = strtotime ( $_POST["ks_events_enddate"] . $_POST["ks_events_endtime"]);
update_post_meta($post_id, "ks_events_enddate", $updateendd );

if(!isset($_POST["ks_events_state"])):
return $post;
endif;
$updatestate = $_POST["ks_events_state"];
update_post_meta($post_id, "ks_events_state", $updatestate );

if(!isset($_POST["ks_events_city"])):
return $post;
endif;
$updatecity = $_POST["ks_events_city"];
update_post_meta($post_id, "ks_events_city", $updatecity );

if(!isset($_POST["ks_events_address"])):
return $post;
endif;
$updateaddress = $_POST["ks_events_address"];
update_post_meta($post_id, "ks_events_address", $updateaddress );

}

// 6. Customize Update Messages
 
add_filter('post_updated_messages', 'events_updated_messages');
 
function events_updated_messages( $messages ) {
 
  global $post, $post_ID;
 
  $messages['ks_events'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Event updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Event updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Event published. <a href="%s">View event</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Event saved.'),
    8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
 
  return $messages;
}

// JS Datepicker UI disable default JQ UI and use custom
 
function events_styles() {
    global $post_type;
    if( 'ks_events' != $post_type )
        return;
    wp_enqueue_style('ui-datepicker', get_bloginfo('template_url') . '/css/jquery-ui-1.8.18.custom.css');
}
 
function events_scripts() {
    global $post_type;
    if( 'ks_events' != $post_type )
        return;
    wp_enqueue_script('jquery-ui', get_bloginfo('template_url') . '/js/jquery-ui-1.8.18.custom.min.js', array('jquery'));
    wp_enqueue_script('ui-datepicker', get_bloginfo('template_url') . '/js/jquery.ui.datepicker.min.js');
    wp_enqueue_script('custom_script', get_bloginfo('template_url').'/js/ks-admin.js', array('jquery'));

	wp_localize_script(
		'custom_script',
		'ks_variables',
		array (
			'templateUrl' => get_bloginfo('template_url')
			
		) 
	);
}
 
add_action( 'admin_print_styles-post.php', 'events_styles', 1000 );
add_action( 'admin_print_styles-post-new.php', 'events_styles', 1000 );
 
add_action( 'admin_print_scripts-post.php', 'events_scripts', 1000 );
add_action( 'admin_print_scripts-post-new.php', 'events_scripts', 1000 );

// shotcode function to display events 

/* ------------------- THEME FORCE ---------------------- */

/*
 * EVENTS SHORTCODES (CUSTOM POST TYPE)
 * http://www.noeltock.com/web-design/wordpress/how-to-custom-post-types-for-events-pt-2/
 */

// 1) FULL EVENTS
//***********************************************************************************


function ks_events_full ( $atts ) {

// - define arguments -
extract(shortcode_atts(array(
    'limit' => '10', // # of events to show
 ), $atts));

// ===== OUTPUT FUNCTION =====

ob_start();

// ===== LOOP: FULL EVENTS SECTION =====

// - hide events that are older than 6am today (because some parties go past your bedtime) -

$today6am = strtotime('today 6:00') + ( get_option( 'gmt_offset' ) * 3600 );

		$year = date('Y');
		$month = date('m');
		$previous =  date("Y/m",strtotime($year."-".$month."-01 -1 months"));
		$next =  date("Y/m",strtotime($year."-".$month."-01 +1 months"));

// - query -
global $wpdb;
$querystr = "
    SELECT *
    FROM $wpdb->posts wposts, $wpdb->postmeta metastart, $wpdb->postmeta metaend
    WHERE (wposts.ID = metastart.post_id AND wposts.ID = metaend.post_id)
    AND (metaend.meta_key = 'ks_events_enddate' AND metaend.meta_value > $today6am )
    AND metastart.meta_key = 'ks_events_enddate'
    AND wposts.post_type = 'ks_events'
    AND wposts.post_status = 'publish'
    ORDER BY metastart.meta_value ASC LIMIT $limit
 ";

$events = $wpdb->get_results($querystr, OBJECT);

// - declare fresh day -
$daycheck = null; ?>

	<p><?php echo $previous; ?></p>

	<h2><?php echo date('M'); ?> </h2> 

<?php

// - loop -
if ($events):
global $post;
foreach ($events as $post):
setup_postdata($post);

// - custom variables -
$custom = get_post_custom(get_the_ID());
$sd = $custom["ks_events_startdate"][0];
$ed = $custom["ks_events_enddate"][0];

// - determine if it's a new day -
$longdate = date("l, F j, Y", $sd);
if ($daycheck == null) { echo '<h2 class="full-events">' . $longdate . '</h2>'; }
if ($daycheck != $longdate && $daycheck != null) { echo '<h2 class="full-events">' . $longdate . '</h2>'; }

// - local time format -
$time_format = get_option('time_format');
$stime = date($time_format, $sd);
$etime = date($time_format, $ed);

// add event calendar navigation


// - output - ?>
<div class="full-events">
	
    <div class="text">
        <div class="title">
            <div class="time"><?php echo $stime . ' - ' . $etime; ?></div>
            <div class="eventtext"><?php the_title(); ?></div>
        </div>
    </div>
     <div class="desc"><?php if (strlen($post->post_content) > 150) { echo substr($post->post_content, 0, 150) . '...'; } else { echo $post->post_content; } ?></div>
</div>
<?php

// - fill daycheck with the current day -
$daycheck = $longdate;



endforeach;
else :
endif; 

// ===== RETURN: FULL EVENTS SECTION =====

$output = ob_get_contents();
ob_end_clean();
return $output;
}

add_shortcode('ks-events-full', 'ks_events_full'); // You can now call onto this shortcode with [ks-events-full limit='20']


	
?>