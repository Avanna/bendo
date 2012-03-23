<?php




/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {
	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	$google_fonts = array(	array( 'name' => "Cantarell", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Cardo", 'variant' => ''),
							array( 'name' => "Crimson Text", 'variant' => ''),
							array( 'name' => "Droid Sans", 'variant' => ':r,b'),
							array( 'name' => "Droid Sans Mono", 'variant' => ''),
							array( 'name' => "Droid Serif", 'variant' => ':r,b,i,bi'),
							array( 'name' => "IM Fell DW Pica", 'variant' => ':r,i'),
							array( 'name' => "Inconsolata", 'variant' => ''),
							array( 'name' => "Josefin Sans", 'variant' => ':400,400italic,700,700italic'),
							array( 'name' => "Josefin Slab", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Lobster", 'variant' => ''),
							array( 'name' => "Molengo", 'variant' => ''),
							array( 'name' => "Nobile", 'variant' => ':r,b,i,bi'),
							array( 'name' => "OFL Sorts Mill Goudy TT", 'variant' => ':r,i'),
							array( 'name' => "Old Standard TT", 'variant' => ':r,b,i'),
							array( 'name' => "Reenie Beanie", 'variant' => ''),
							array( 'name' => "Tangerine", 'variant' => ':r,b'),
							array( 'name' => "Vollkorn", 'variant' => ':r,b'),
							array( 'name' => "Yanone Kaffeesatz", 'variant' => ':r,b'),
							array( 'name' => "Cuprum", 'variant' => ''),
							array( 'name' => "Neucha", 'variant' => ''),
							array( 'name' => "Neuton", 'variant' => ''),
							array( 'name' => "PT Sans", 'variant' => ':r,b,i,bi'),
							array( 'name' => "PT Sans Caption", 'variant' => ':r,b'),
							array( 'name' => "PT Sans Narrow", 'variant' => ':r,b'),
							array( 'name' => "Philosopher", 'variant' => ''),
							array( 'name' => "Allerta", 'variant' => ''),
							array( 'name' => "Allerta Stencil", 'variant' => ''),
							array( 'name' => "Arimo", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Arvo", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Bentham", 'variant' => ''),
							array( 'name' => "Coda", 'variant' => ':800'),
							array( 'name' => "Cousine", 'variant' => ''),
							array( 'name' => "Covered By Your Grace", 'variant' => ''),
				 			array( 'name' => "Geo", 'variant' => ''),
							array( 'name' => "Just Me Again Down Here", 'variant' => ''),
							array( 'name' => "Puritan", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Raleway", 'variant' => ':100'),
							array( 'name' => "Tinos", 'variant' => ':r,b,i,bi'),
							array( 'name' => "UnifrakturCook", 'variant' => ':bold'),
							array( 'name' => "UnifrakturMaguntia", 'variant' => ''),
							array( 'name' => "Mountains of Christmas", 'variant' => ''),
							array( 'name' => "Lato", 'variant' => ':400,700,400italic'),
							array( 'name' => "Orbitron", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Allan", 'variant' => ':bold'),
							array( 'name' => "Anonymous Pro", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Copse", 'variant' => ''),
							array( 'name' => "Kenia", 'variant' => ''),
							array( 'name' => "Ubuntu", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Vibur", 'variant' => ''),
							array( 'name' => "Sniglet", 'variant' => ':800'),
							array( 'name' => "Syncopate", 'variant' => ''),
							array( 'name' => "Cabin", 'variant' => ':400,400italic,700,700italic,'),
							array( 'name' => "Merriweather", 'variant' => ''),
							array( 'name' => "Maiden Orange", 'variant' => ''),
							array( 'name' => "Just Another Hand", 'variant' => ''),
							array( 'name' => "Kristi", 'variant' => ''),
							array( 'name' => "Corben", 'variant' => ':b'),
							array( 'name' => "Gruppo", 'variant' => ''),
							array( 'name' => "Buda", 'variant' => ':light'),
							array( 'name' => "Lekton", 'variant' => ''),
							array( 'name' => "Luckiest Guy", 'variant' => ''),
							array( 'name' => "Crushed", 'variant' => ''),
							array( 'name' => "Chewy", 'variant' => ''),
							array( 'name' => "Coming Soon", 'variant' => ''),
							array( 'name' => "Crafty Girls", 'variant' => ''),
							array( 'name' => "Fontdiner Swanky", 'variant' => ''),
							array( 'name' => "Permanent Marker", 'variant' => ''),
							array( 'name' => "Rock Salt", 'variant' => ''),
							array( 'name' => "Sunshiney", 'variant' => ''),
							array( 'name' => "Unkempt", 'variant' => ''),
							array( 'name' => "Calligraffitti", 'variant' => ''),
							array( 'name' => "Cherry Cream Soda", 'variant' => ''),
							array( 'name' => "Homemade Apple", 'variant' => ''),
							array( 'name' => "Irish Growler", 'variant' => ''),
							array( 'name' => "Kranky", 'variant' => ''),
							array( 'name' => "Schoolbell", 'variant' => ''),
							array( 'name' => "Slackey", 'variant' => ''),
							array( 'name' => "Walter Turncoat", 'variant' => ''),
							array( 'name' => "Radley", 'variant' => ''),
							array( 'name' => "Meddon", 'variant' => ''),
							array( 'name' => "Kreon", 'variant' => ':r,b'),
							array( 'name' => "Dancing Script", 'variant' => ''),
							array( 'name' => "Goudy Bookletter 1911", 'variant' => ''),
							array( 'name' => "PT Serif Caption", 'variant' => ':r,i'),
							array( 'name' => "PT Serif", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Astloch", 'variant' => ':b'),
							array( 'name' => "Bevan", 'variant' => ''),
							array( 'name' => "Anton", 'variant' => ''),
							array( 'name' => "Expletus Sans", 'variant' => ':b'),
							array( 'name' => "VT323", 'variant' => ''),
							array( 'name' => "Pacifico", 'variant' => ''),
							array( 'name' => "Candal", 'variant' => ''),
							array( 'name' => "Architects Daughter", 'variant' => ''),
							array( 'name' => "Indie Flower", 'variant' => ''),
							array( 'name' => "League Script", 'variant' => ''),
							array( 'name' => "Quattrocento", 'variant' => ''),
							array( 'name' => "Amaranth", 'variant' => ''),
							array( 'name' => "Irish Grover", 'variant' => ''),
							array( 'name' => "Oswald", 'variant' => ''),
							array( 'name' => "EB Garamond", 'variant' => ''),
							array( 'name' => "Nova Round", 'variant' => ''),
							array( 'name' => "Nova Slim", 'variant' => ''),
							array( 'name' => "Nova Script", 'variant' => ''),
							array( 'name' => "Nova Cut", 'variant' => ''),
							array( 'name' => "Nova Mono", 'variant' => ''),
							array( 'name' => "Nova Oval", 'variant' => ''),
							array( 'name' => "Nova Flat", 'variant' => ''),
							array( 'name' => "Terminal Dosis Light", 'variant' => ''),
							array( 'name' => "Michroma", 'variant' => ''),
							array( 'name' => "Miltonian", 'variant' => ''),
							array( 'name' => "Miltonian Tattoo", 'variant' => ''),
							array( 'name' => "Annie Use Your Telescope", 'variant' => ''),
							array( 'name' => "Dawning of a New Day", 'variant' => ''),
							array( 'name' => "Sue Ellen Francisco", 'variant' => ''),
							array( 'name' => "Waiting for the Sunrise", 'variant' => ''),
							array( 'name' => "Special Elite", 'variant' => ''),
							array( 'name' => "Quattrocento Sans", 'variant' => ''),
							array( 'name' => "Smythe", 'variant' => ''),
							array( 'name' => "The Girl Next Door", 'variant' => ''),
							array( 'name' => "Aclonica", 'variant' => ''),
							array( 'name' => "News Cycle", 'variant' => ''),
							array( 'name' => "Damion", 'variant' => ''),
							array( 'name' => "Wallpoet", 'variant' => ''),
							array( 'name' => "Over the Rainbow", 'variant' => ''),
							array( 'name' => "MedievalSharp", 'variant' => ''),
							array( 'name' => "Six Caps", 'variant' => ''),
							array( 'name' => "Swanky and Moo Moo", 'variant' => ''),
							array( 'name' => "Bigshot One", 'variant' => ''),
							array( 'name' => "Francois One", 'variant' => ''),
							array( 'name' => "Sigmar One", 'variant' => ''),
							array( 'name' => "Carter One", 'variant' => ''),
							array( 'name' => "Holtwood One SC", 'variant' => ''),
							array( 'name' => "Paytone One", 'variant' => ''),
							array( 'name' => "Monofett", 'variant' => ''),
							array( 'name' => "Rokkitt", 'variant' => ':400,700'),
							array( 'name' => "Megrim", 'variant' => ''),
							array( 'name' => "Judson", 'variant' => ':r,ri,b'),
							array( 'name' => "Didact Gothic", 'variant' => ''),
							array( 'name' => "Play", 'variant' => ':r,b'),
							array( 'name' => "Ultra", 'variant' => ''),
							array( 'name' => "Metrophobic", 'variant' => ''),
							array( 'name' => "Mako", 'variant' => ''),
							array( 'name' => "Shanti", 'variant' => ''),
							array( 'name' => "Caudex", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Jura", 'variant' => ''),
							array( 'name' => "Ruslan Display", 'variant' => ''),
							array( 'name' => "Brawler", 'variant' => ''),
							array( 'name' => "Nunito", 'variant' => ''),
							array( 'name' => "Wire One", 'variant' => ''),
							array( 'name' => "Podkova", 'variant' => ''),
							array( 'name' => "Muli", 'variant' => ''),
							array( 'name' => "Maven Pro", 'variant' => ''),
							array( 'name' => "Tenor Sans", 'variant' => ''),
							array( 'name' => "Limelight", 'variant' => ''),
							array( 'name' => "Playfair Display", 'variant' => ''),
							array( 'name' => "Artifika", 'variant' => ''),
							array( 'name' => "Lora", 'variant' => ''),
							array( 'name' => "Kameron", 'variant' => ':r,b'),
							array( 'name' => "Cedarville Cursive", 'variant' => ''),
							array( 'name' => "Zeyada", 'variant' => ''),
							array( 'name' => "La Belle Aurore", 'variant' => ''),
							array( 'name' => "Shadows Into Light", 'variant' => ''),
							array( 'name' => "Lobster Two", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Nixie One", 'variant' => ''),
							array( 'name' => "Redressed", 'variant' => ''),
							array( 'name' => "Bangers", 'variant' => ''),
							array( 'name' => "Open Sans Condensed", 'variant' => ':300,300italic'),
							array( 'name' => "Open Sans", 'variant' => ':r,i,b,bi'),
							array( 'name' => "Varela", 'variant' => ''),
							array( 'name' => "Goblin One", 'variant' => ''),
							array( 'name' => "Asset", 'variant' => ''),
							array( 'name' => "Gravitas One", 'variant' => ''),
							array( 'name' => "Hammersmith One", 'variant' => ''),
							array( 'name' => "Stardos Stencil", 'variant' => ''),
							array( 'name' => "Love Ya Like A Sister", 'variant' => ''),
							array( 'name' => "Loved by the King", 'variant' => ''),
							array( 'name' => "Bowlby One SC", 'variant' => ''),
							array( 'name' => "Forum", 'variant' => ''),
							array( 'name' => "Patrick Hand", 'variant' => ''),
							array( 'name' => "Varela Round", 'variant' => ''),
							array( 'name' => "Yeseva One", 'variant' => ''),
							array( 'name' => "Give You Glory", 'variant' => ''),
							array( 'name' => "Modern Antiqua", 'variant' => ''),
							array( 'name' => "Bowlby One", 'variant' => ''),
							array( 'name' => "Tienne", 'variant' => ''),
							array( 'name' => "Istok Web", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Yellowtail", 'variant' => ''),
							array( 'name' => "Pompiere", 'variant' => ''),
							array( 'name' => "Unna", 'variant' => ''),
							array( 'name' => "Rosario", 'variant' => ''),
							array( 'name' => "Leckerli One", 'variant' => ''),
							array( 'name' => "Snippet", 'variant' => ''),
							array( 'name' => "Ovo", 'variant' => ''),
							array( 'name' => "IM Fell English", 'variant' => ':r,i'),
							array( 'name' => "IM Fell English SC", 'variant' => ''),
							array( 'name' => "Gloria Hallelujah", 'variant' => ''),
							array( 'name' => "Kelly Slab", 'variant' => ''),
							array( 'name' => "Black Ops One", 'variant' => ''),
							array( 'name' => "Carme", 'variant' => ''),
							array( 'name' => "Aubrey", 'variant' => ''),
							array( 'name' => "Federo", 'variant' => ''),
							array( 'name' => "Delius", 'variant' => ''),
							array( 'name' => "Rochester", 'variant' => ''),
							array( 'name' => "Rationale", 'variant' => ''),
							array( 'name' => "Abel", 'variant' => ''),
							array( 'name' => "Marvel", 'variant' => ':r,b,i,bi'),
							array( 'name' => "Actor", 'variant' => ''),
							array( 'name' => "Delius Swash Caps", 'variant' => ''),
							array( 'name' => "Smokum", 'variant' => ''),
							array( 'name' => "Tulpen One", 'variant' => ''),
							array( 'name' => "Coustard", 'variant' => ':r,b'),
							array( 'name' => "Andika", 'variant' => ''),
							array( 'name' => "Alice", 'variant' => ''),
							array( 'name' => "Questrial", 'variant' => ''),
							array( 'name' => "Comfortaa", 'variant' => ':r,b'),
							array( 'name' => "Geostar", 'variant' => ''),
							array( 'name' => "Geostar Fill", 'variant' => ''),
							array( 'name' => "Volkhov", 'variant' => ''),
							array( 'name' => "Voltaire", 'variant' => ''),
							array( 'name' => "Montez", 'variant' => ''),
							array( 'name' => "Short Stack", 'variant' => ''),
							array( 'name' => "Vidaloka", 'variant' => ''),
							array( 'name' => "Aldrich", 'variant' => ''),
							array( 'name' => "Numans", 'variant' => ''),
							array( 'name' => "Days One", 'variant' => ''),
							array( 'name' => "Gentium Book Basic", 'variant' => ''),
							array( 'name' => "Monoton", 'variant' => ''),
							array( 'name' => "Alike", 'variant' => ''),
							array( 'name' => "Delius Unicase", 'variant' => ''),
							array( 'name' => "Abril Fatface", 'variant' => ''),
							array( 'name' => "Dorsa", 'variant' => ''),
							array( 'name' => "Antic", 'variant' => ''),
							array( 'name' => "Passero One", 'variant' => ''),
							array( 'name' => "Fanwood Text", 'variant' => ''),
							array( 'name' => "Prociono", 'variant' => ''),
							array( 'name' => "Merienda One", 'variant' => ''),
							array( 'name' => "Changa One", 'variant' => ''),
							array( 'name' => "Julee", 'variant' => ''),
							array( 'name' => "Prata", 'variant' => ''),
							array( 'name' => "Adamina", 'variant' => ''),
							array( 'name' => "Sorts Mill Goudy", 'variant' => ''),
							array( 'name' => "Terminal Dosis", 'variant' => ''),
							array( 'name' => "Sansita One", 'variant' => ''),
							array( 'name' => "Chivo", 'variant' => ''),
							array( 'name' => "Spinnaker", 'variant' => ''),
							array( 'name' => "Poller One", 'variant' => ''),
							array( 'name' => "Alike Angular", 'variant' => ''),
							array( 'name' => "Gochi Hand", 'variant' => ''),
							array( 'name' => "Poly", 'variant' => ''),
							array( 'name' => "Andada", 'variant' => ''),
							array( 'name' => "Federant", 'variant' => ''),
							array( 'name' => "Ubuntu Condensed", 'variant' => ''),
							array( 'name' => "Ubuntu Mono", 'variant' => ''),
							array( 'name' => "Sancreek", 'variant' => ''),
							array( 'name' => "Coda", 'variant' => ''),
							array( 'name' => "Rancho", 'variant' => ''),
							array( 'name' => "Satisfy", 'variant' => ''),
							array( 'name' => "Pinyon Script", 'variant' => ''),
							array( 'name' => "Vast Shadow", 'variant' => ''),
							array( 'name' => "Marck Script", 'variant' => ''),
							array( 'name' => "Salsa", 'variant' => ''),
							array( 'name' => "Amatic SC", 'variant' => ''),
							array( 'name' => "Quicksand", 'variant' => ''),
							array( 'name' => "Linden Hill", 'variant' => ''),
							array( 'name' => "Corben", 'variant' => ''),
							array( 'name' => "Creepster Caps", 'variant' => ''),
							array( 'name' => "Butcherman Caps", 'variant' => ''),
							array( 'name' => "Eater Caps", 'variant' => ''),
							array( 'name' => "Nosifer Caps", 'variant' => ''),
							array( 'name' => "Atomic Age", 'variant' => ''),
							array( 'name' => "Contrail One", 'variant' => ''),
							array( 'name' => "Jockey One", 'variant' => ''),
							array( 'name' => "Cabin Sketch", 'variant' => ':r,b'),
							array( 'name' => "Cabin Condensed", 'variant' => ':r,b'),
							array( 'name' => "Fjord One", 'variant' => ''),
							array( 'name' => "Rametto One", 'variant' => ''),
							array( 'name' => "Mate", 'variant' => ':r,i'),
							array( 'name' => "Mate SC", 'variant' => ''),
							array( 'name' => "Arapey", 'variant' => ':r,i'),
							array( 'name' => "Supermercado One", 'variant' => ''),
							array( 'name' => "Petrona", 'variant' => ''),
							array( 'name' => "Lancelot", 'variant' => ''),
							array( 'name' => "Convergence", 'variant' => ''),
							array( 'name' => "Bitter", 'variant' => '')
	);
	
	$font_names = array();

	
	foreach ($google_fonts as $font) {
			$font_names[] = $font['name'] ;
		}
		
	
	// Test data
	$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	
	$gallery_columns_array = array("three" => "Three", "four" => "Four","five" => "Five");
	
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	// logo choices 
	
	$logo_choices = array('site_title' => 'Site Title', 'custom_logo' => 'Custom Logo');
	
	// slider effects
	
	$slider_effects = array(	
						'sliceDown' => 'sliceDown',
						'sliceDownLeft' => 'sliceDownLeft',
						'sliceUp' => 'sliceUp',
						'sliceUpLeft' => 'sliceUpLeft',
						'sliceUpDown' => 'sliceUpDown',
						'sliceUpDownLeft' => 'sliceUpDownLeft',
						'fold' => 'fold',
						'fade' => 'fade',
						'random' => 'random',
						'slideInRight' => 'slideInRight',
						'slideInLeft' => 'slideInRight',
						'boxRandom' => 'boxRandom',
						'boxRain' => 'boxRain',
						'boxRainReverse' => 'boxRainReverse',
						'boxRainGrow' => 'boxRainReverse',
						'boxRainGrowReverse' => 'boxRainReverse'
						);
						
	$slider_speed = array ('300' => '300', '500' => '500', '800' => '800', '1200' => '1200', '1800' => '1800');
	
	$slider_pause = array ('2000' => '2000', '3000' => '3000', '4000' => '4000', '5000' => '5000', '6000' => '6000');
	
	$caption_opacity = array ('0'=>'0', '0.2' =>'0.2', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7'=> '0.7','0.8' => '0.8','0.9'=>'0.9','1' => '1');
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';
		
	$options = array();
		
	$options[] = array( "name" => "Basic Settings",
						"type" => "heading");
						
	$options[] = array( "name" => "Site title or logo",
						"desc" => "Choose to use site title or custom logo.",
						"id" => "logo_choice",
						"std" => "one",
						"type" => "radio",
						"options" => $logo_choices);
		
	$options[] = array( "name" => "logo uploader",
						"desc" => "Upload a custom logo.",
						"id" => "logo_uploader",
						"type" => "upload");
	
	$options[] = array( "name" => "favicon uploader",
						"desc" => "Upload a custom favicon.",
						"id" => "favicon_uploader",
						"type" => "upload");
						
	$options[] = array( "name" => "Select a Font",
						"desc" => "select a font to use",
						"id" => "example_select_categories",
						"type" => "select",
						"options" => $font_names);
							
	$options[] = array( "name" => "Twitter Username",
						"desc" => "Default Twitter username used to pull the latest tweets",
						"id" => "twitter_username",
						"std" => "",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => "Number of Posts",
						"desc" => "Number of posts to show on front page",
						"id" => "number_of_posts",
						"std" => 2,
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => "Gallery Columns",
						"desc" => "Number of columns on the gallery page",
						"id" => "gallery_columns",
						"std" => "five",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $gallery_columns_array);
						
	$options[] = array( "name" => "Show Albums on front page",
						"desc" => "This will hide or show albums on the front page",
						"id" => "albums_checkbox",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "intro",
						"desc" => "Front page short introduction. Leave blank if you don't want to have an intro paragragh.",
						"id" => "intro",
						"std" => "",
						"type" => "textarea");
						
	$options[] = array( "name" => "Google Analytics",
						"desc" => "Enter or paste your google analytics code.",
						"id" => "google_analytics",
						"std" => "",
						"type" => "text",
						"class" => "mini"); //mini, tiny, small
					
	// begin layout settings

	$options[] = array( "name" => "Layout",
						"type" => "heading");
						
	$options[] = array( "name" => "Show full page gallery with no side bar",
						"desc" => "Show the sidebar on the gallery page",
						"id" => "gallery_sidebar",
						"std" => "0",
						"type" => "checkbox");
					
	$options[] = array( "name" => "Make a custom color scheme",
						"desc" => "This will allow you to set custom colors below. Just uncheck it to revert to the default color scheme. Please Note that the new color scheme relies on javascript being enabled in the browser",
						"id" => "color_scheme",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Headline Color",
						"desc" => "Select headline color.",
						"id" => "headline_color",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "link Color",
						"desc" => "Select headline color.",
						"id" => "link_color",
						"std" => "",
						"type" => "color");
	
	// begin slider settings
						
	$options[] = array( "name" => "slider Settings",
						"type" => "heading");
						
	$options[] = array( "name" => "Show slider on front page",
						"desc" => "This will hide or show the slider on the front page",
						"id" => "slider_checkbox",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Slider Effect",
						"desc" => "Select the transition effect for the slider",
						"id" => "slider_effects",
						"std" => "fade",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $slider_effects);
						
	$options[] = array( "name" => "Slider Speed",
						"desc" => "Select the slider animation speed. Default = 500",
						"id" => "slider_speed",
						"std" => "500",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $slider_speed);
						
	$options[] = array( "name" => "Slider Pause",
						"desc" => "Select the slider pause time. Default is 3000 which is 3 sec",
						"id" => "slider_pause",
						"std" => "3000",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $slider_pause);
			
	$options[] = array( "name" => "Show captions on slider",
						"desc" => "Show image captions on the slider",
						"id" => "captions_checkbox",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Caption Opacity",
						"desc" => "Select the slider caption opacity",
						"id" => "caption_opacity",
						"std" => "0.8",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $caption_opacity);
						
	$options[] = array( "name" => "Show Directional arrows",
						"desc" => "This will hide or show directional navigation for the slider",
						"id" => "slider_navigation",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Show arrows only on hover",
						"desc" => "This will show the arrows only when the mouse hovers over the slider",
						"id" => "hover_arrows",
						"std" => "1",
						"type" => "checkbox");
						
	//delete from here after development
								
	$options[] = array( "name" => "Input Text",
						"desc" => "A text input field.",
						"id" => "example_text",
						"std" => "Default Value",
						"type" => "text");
							
	$options[] = array( "name" => "Textarea",
						"desc" => "Textarea description.",
						"id" => "example_textarea",
						"std" => "Default Text",
						"type" => "textarea"); 
						
	$options[] = array( "name" => "Input Select Small",
						"desc" => "Small Select Box.",
						"id" => "example_select",
						"std" => "three",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $test_array);			 
						
	$options[] = array( "name" => "Input Select Wide",
						"desc" => "A wider select box.",
						"id" => "example_select_wide",
						"std" => "two",
						"type" => "select",
						"options" => $test_array);
						
	$options[] = array( "name" => "Select a Category",
						"desc" => "Passed an array of categories with cat_ID and cat_name",
						"id" => "example_select_categories",
						"type" => "select",
						"options" => $options_categories);
						
	$options[] = array( "name" => "Select a Page",
						"desc" => "Passed an pages with ID and post_title",
						"id" => "example_select_pages",
						"type" => "select",
						"options" => $options_pages);
						
	$options[] = array( "name" => "Input Radio (one)",
						"desc" => "Radio select with default options 'one'.",
						"id" => "example_radio",
						"std" => "one",
						"type" => "radio",
						"options" => $test_array);
							
	$options[] = array( "name" => "Example Info",
						"desc" => "This is just some example information you can put in the panel.",
						"type" => "info");
											
	$options[] = array( "name" => "Input Checkbox",
						"desc" => "Example checkbox, defaults to true.",
						"id" => "example_checkbox",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Advanced Settings",
						"type" => "heading");
						
	$options[] = array( "name" => "Check to Show a Hidden Text Input",
						"desc" => "Click here and see what happens.",
						"id" => "example_showhidden",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Hidden Text Input",
						"desc" => "This option is hidden unless activated by a checkbox click.",
						"id" => "example_text_hidden",
						"std" => "Hello",
						"class" => "hidden",
						"type" => "text");
						
	$options[] = array( "name" => "Uploader Test",
						"desc" => "This creates a full size uploader that previews the image.",
						"id" => "example_uploader",
						"type" => "upload");
						
	$options[] = array( "name" => "Example Image Selector",
						"desc" => "Images for layout.",
						"id" => "example_images",
						"std" => "2c-l-fixed",
						"type" => "images",
						"options" => array(
							'1col-fixed' => $imagepath . '1col.png',
							'2c-l-fixed' => $imagepath . '2cl.png',
							'2c-r-fixed' => $imagepath . '2cr.png')
						);
						
	$options[] = array( "name" =>  "Example Background",
						"desc" => "Change the background CSS.",
						"id" => "example_background",
						"std" => $background_defaults, 
						"type" => "background");
								
	$options[] = array( "name" => "Multicheck",
						"desc" => "Multicheck description.",
						"id" => "example_multicheck",
						"std" => $multicheck_defaults, // These items get checked by default
						"type" => "multicheck",
						"options" => $multicheck_array);
							
	$options[] = array( "name" => "Colorpicker",
						"desc" => "No color selected by default.",
						"id" => "example_colorpicker",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Typography",
						"desc" => "Example typography.",
						"id" => "example_typography",
						"std" => array('size' => '12px','face' => 'verdana','style' => 'bold italic','color' => '#123456'),
						"type" => "typography");			
	return $options;
}