<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">

  <!-- www.phpied.com/conditional-comments-block-downloads/ -->
  <!--[if IE]><![endif]-->

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!--  Mobile Viewport Fix
        j.mp/mobileviewport & davidbcalhoun.com/2010/viewport-metatag 
  device-width : Occupy full width of the screen in its current orientation
  initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
  maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width
  -->
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">


	<!--  get theme options from database -->

	<?php 
	
	$options = array();
	
	$options = get_option('bendo'); 
		print_r($options);
	?>


  <!-- Place favicon.ico and apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">


  <!-- CSS : implied media="all" -->

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/style.css" />

	<?php 
		
	$color_scheme = '';
	
	if(array_key_exists('theme_scheme', $options)) {
		$color_scheme = $options['theme_scheme'];
	}
	
	switch ($color_scheme) {
			case "light": ?>
			
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/style-light.css" />
	
	<?php break; 
		case "dark": ?>

  		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/style.css" />

	<?php break; 
		case "default": 
		 ?>
		
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/style.css" />
		
	<?php break; } ?>
	
  <!-- For the less-enabled mobile browsers like Opera Mini -->
  <link rel="stylesheet" media="handheld" href="css/handheld.css?v=1">

	<!-- hook up music player options -->

	
	
  <!-- Playlist Styles -->
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/playlist/css/playlist.css">
 
  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="<?php bloginfo('template_directory'); ?>/js/modernizr-1.5.min.js"></script>


<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/nivo-slider.css" type="text/css" media="screen"  />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/fullcalendar.css" type="text/css" media="screen"  />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen"  />

<!-- nivo slider themes styles -->

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/themes/default/default.css" type="text/css" media="screen"  /> 

<!-- custom layout css options -->

	<?php if($options['gallery_sidebar'] == 1 ) {?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/gallery-sidebar.css" type="text/css" media="screen"  /> 
	<?php } ?>

<!-- google fonts -->

<link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

</head>





<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->

<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->

<body <?php body_class(); ?>>

	<div id="main_wrapper">

	<div id="wrapper" class="clearfix">
		
		<header class="clearfix">
			
	<?php if(($options['logo_choice'] === 'custom_logo')) {
				if($options['logo_uploader']) {
					$logo = $options['logo_uploader'];
				}
		
			if( array_key_exists('logo_choice', $options)) {
				
				if($options['logo_choice'] === 'custom_logo') { ?>
					
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo $logo; ?>" /></a>
					 
			<?php	}
			}
		}
		else {
	?>
			<hgroup>
				<h1 id="logo"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
	<?php } ?>
		</header><!--/header-->
		
		
	
		<div id="content" class="clearfix">
			
		<?php wp_nav_menu(array('menu' => 'main_nav', 'menu_id' =>'main_nav')); ?>
