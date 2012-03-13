<?php
// JavaScript
add_action('admin_init', 'settings_page_include_js');
function settings_page_include_js(){
    wp_register_script('settings_page_js', get_template_directory_uri().'/settings/js/settings-script.js', false);
    wp_enqueue_script('settings_page_js');
	wp_register_script('settings_page_js_colorpicker', get_template_directory_uri().'/settings/js/colorpicker.js', false);
    wp_enqueue_script('settings_page_js_colorpicker');

}

// CSS
add_action('admin_print_styles', 'settings_page_include_styles');
function settings_page_include_styles(){
    wp_register_style('settings_page_style', get_template_directory_uri().'/settings/css/settings-style.css', false);
    wp_enqueue_style('settings_page_style');   
	wp_register_style('settings_page_colorpicker', get_template_directory_uri().'/settings/css/colorpicker.css', false);
    wp_enqueue_style('settings_page_colorpicker');   
}

/* Init plugin options to white list our options */
add_action( 'admin_init', 'theme_options_init' );
function theme_options_init(){
	register_setting( 'odthemes_options', 'odthemes_theme_options', 'theme_options_validate' );
}

/* Add Player Settings Menu to the custom post type 'tracklist' */
add_action( 'admin_menu', 'theme_options_add_page' );
function theme_options_add_page() {
	add_submenu_page('edit.php?post_type=playlist', __( 'Player Settings', 'odthemes' ), __( 'Player Settings', 'odthemes' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/* Create the options page */
function theme_options_do_page() {
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
		
?>

<!-- OD Panel Page Wrap -->
<form method="post" action="options.php">
<div id="od-panel">

<!-- Border Styles all around -->
<div class="glowbr">

	<!-- Header -->
	<div id="od_header" class="polish">
		<a id="od_logo" href="<?php echo get_admin_url(); ?>edit.php?post_type=playlist&page=theme_options">OD Themes Framework</a>
		<div class="clear"></div>
	</div>
	<div id="od_bar"></div> <!-- Graphic Bar below the header -->
	<!-- END Header -->
	

<!-- Save Changes Main Button -->
<div class="button-zone-wrapper zone-top">
	<div class="button-zone">
		<span class="top"><button class="save secondary" id="od_save" name="od_save" type="submit"><?php _e("Save Changes","odfw"); ?></button></span>
	</div>
</div>

<?php settings_fields( 'odthemes_options' ); ?>
<?php $options = get_option( 'odthemes_theme_options' ); ?>

<!-- Content Container -->		
<div id="od_main">

<!-- Sidebar Navigation Container -->	
<div id="od-panel-sidebar">
	<ul class="tabs">
		<li class="general"><a href="#od-panel-section-general">General Settings</a></li>
		<li class="appearance"><a href="#od-panel-section-appearance">Player Appearance</a></li>
		<li class="misc"><a href="#od-panel-section-misc">Miscellaneous</a></li>
	</ul>
</div>

<!-- Tabs Containers -->			
<div id="od-panel-content" class="tab_container">
		
<!-- General Section -->		
<div class="od-panel-section tab_content" id="od-panel-section-general">
			
	<!-- Number of Tracks to Display -->
	<div class="od-panel-field">
		<fieldset class="title">
			<label class="description" for="odthemes_theme_options[music_tracks_to_show]"><?php _e( 'Number of Tracks', 'odthemes' ); ?></label>
			<div class="od-panel-description">Number of tracks to display on the playlist?</div>
		</fieldset>
		<fieldset class="data">
			<input id="odthemes_theme_options[music_tracks_to_show]" class="regular-text" type="text" name="odthemes_theme_options[music_tracks_to_show]" value="<?php esc_attr_e( $options['music_tracks_to_show'] ); ?>" />
		</fieldset>
	<div class="clear"></div>
	</div>
				
	<!-- Descripiton Text -->
	<div class="od-panel-field">
		<fieldset class="title">
			<label class="description" for="odthemes_theme_options[music_player_description]"><?php _e( 'Description', 'odthemes' ); ?></label>
			<div class="od-panel-description">Add description for the player.</div>
		</fieldset>
		<fieldset class="data">
			<textarea id="odthemes_theme_options[music_player_description]" class="large-text" cols="50" rows="10" name="odthemes_theme_options[music_player_description]"><?php echo esc_textarea( $options['music_player_description'] ); ?></textarea>
		</fieldset>
	<div class="clear"></div>
	</div>
							
</div>
			
<!-- Appearance Section -->								
<div class="od-panel-section tab_content" id="od-panel-section-appearance">
			
		<!-- Change Appearance Checkbox -->
		<div class="od-panel-field">
			<fieldset class="title">
				<label class="description" for="odthemes_theme_options[od_custom_css]"><?php _e( 'Use Custom Styles?', 'odthemes' ); ?></label>
				<div class="od-panel-description">Are you going to change the appearance of your music player?</div>
			</fieldset>
			<fieldset class="data">
				<input id="odthemes_theme_options[od_custom_css]" class="checkme" name="odthemes_theme_options[od_custom_css]" type="checkbox" value="1" <?php checked( '1', $options['od_custom_css'] ); ?> />
			</fieldset>
		<div class="clear"></div>
		</div>
			
	<!-- Show Settings if Appearance checkbox is checked -->
	<div id="extra">
			
		<!-- Description Font Color -->
		<div class="od-panel-field">
			<fieldset class="title">
				<label class="description" for="odthemes_theme_options[od_font_color]"><?php _e( 'Player Description Color', 'odthemes' ); ?></label>
				<div class="od-panel-description">Change the color of the description page. <br />(ex. enter hex #CCCCCC or click to choose)</div>
			</fieldset>
			<fieldset class="data">
				<input id="colorpicker" class="regular-text" type="text" name="odthemes_theme_options[od_font_color]" value="<?php esc_attr_e( $options['od_font_color'] ); ?>" />
			</fieldset>
		<div class="clear"></div>
		</div>
				
		<!-- Description Font Size -->
		<div class="od-panel-field">
			<fieldset class="title">
				<label class="description" for="odthemes_theme_options[od_font_size]"><?php _e( 'Player Description Font Size', 'odthemes' ); ?></label>
				<div class="od-panel-description">Change description font size. <br />(ex. 12px or 2em)</div>
			</fieldset>
			<fieldset class="data">
				<input id="odthemes_theme_options[od_font_size]" class="regular-text" type="text" name="odthemes_theme_options[od_font_size]" value="<?php esc_attr_e( $options['od_font_size'] ); ?>" />
			</fieldset>
		<div class="clear"></div>
		</div>
			
	</div> <!-- END Show Settings if Appearance checkbox is checked -->
			
</div>
 
 <!-- Miscellaneous Section -->
<div class="od-panel-section tab_content" id="od-panel-section-misc">
			
	<!-- Footer Text -->
    <div class="od-panel-field">
		<fieldset class="title">
			<label class="description" for="odthemes_theme_options[od_footer_text]"><?php _e( 'Player Footer Text', 'odthemes' ); ?></label>
			<div class="od-panel-description">Change footer text.</div>
		</fieldset>
		<fieldset class="data">
			<input id="odthemes_theme_options[od_footer_text]" class="regular-text" type="text" name="odthemes_theme_options[od_footer_text]" value="<?php esc_attr_e( $options['od_footer_text'] ); ?>" />
		</fieldset>
	<div class="clear"></div>
	</div>
 
</div>

</div> <!-- END Tabs Containers -->	
<div class="clear"></div>

	
</div> <!-- END Content Container -->

</div>

<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved', 'odthemes' ); ?></strong></p></div>
<?php endif; ?>

</div>
</form> 
<!-- END OD Panel Page Wrap -->

<?php
}

/* Sanitize and validate input. Accepts an array, return a sanitized array. */
function theme_options_validate( $input ) {

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['od_custom_css'] ) )
		$input['od_custom_css'] = null;
	$input['od_custom_css'] = ( $input['od_custom_css'] == 1 ? 1 : 0 );

	// Text input
	$input['music_tracks_to_show'] = wp_filter_nohtml_kses( $input['music_tracks_to_show'] );
	$input['od_font_color'] = wp_filter_nohtml_kses( $input['od_font_color'] );
	$input['od_font_size'] = wp_filter_nohtml_kses( $input['od_font_size'] );
	$input['od_footer_text'] = wp_filter_nohtml_kses( $input['od_footer_text'] );

	// Textarea
	$input['music_player_description'] = wp_filter_post_kses( $input['music_player_description'] );

	return $input;
}