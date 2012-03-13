<!doctype html>
<html lang="en" class="no-js">
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


  <!-- Place favicon.ico and apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">


  <!-- CSS : implied media="all" -->
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/style.css" />

  <!-- For the less-enabled mobile browsers like Opera Mini -->
  <link rel="stylesheet" media="handheld" href="css/handheld.css?v=1">

	<!-- hook up music player options -->

	<?php  $options = get_option('odthemes_theme_options'); ?>
	
  <!-- Playlist Styles -->
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/playlist/css/playlist.css">

	<?php if( $options['od_custom_css'] == '1' ) : ?>  
		
	<style type="text/css" media="screen">  
	.description {  
	<?php if( $options['od_font_color'] != '' ) : ?>color:<?php echo $options['od_font_color']; ?> !important; <?php else: ?><?php endif; ?>  
	<?php if( $options['od_font_size'] != '' ) : ?>font-size:<?php echo $options['od_font_size']; ?> !important; <?php else: ?><?php endif; ?>  
	}  
	</style>  
	
	<?php else: ?>  
	<?php endif; ?>
 
  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="<?php bloginfo('template_directory'); ?>/js/modernizr-1.5.min.js"></script>

<?php wp_head(); ?>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/nivo-slider.css" type="text/css" media="screen"  />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/fullcalendar.css" type="text/css" media="screen"  />

</head>



<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->

<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->

<body>

	<div id="main_wrapper">

	<div id="wrapper" class="clearfix">
		
		<header class="clearfix">

			<h1 id="logo">bendo</h1>
			<p>a premium wordpress musician theme</p>

		</header><!--/header-->
	
		<div id="content">
			
		<?php wp_nav_menu(array('menu' => 'main_nav', 'menu_id' =>'main_nav')); ?>
