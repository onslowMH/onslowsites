<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7" > <![endif]-->
<!--[if IE 7]>    <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8" > <![endif]-->
<!--[if IE 8]>    <html <?php language_attributes(); ?> class="no-js lt-ie9" > <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js" > <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title><?php wp_title('|'); ?></title>
	
	<!-- Mobile viewport optimized: h5bp.com/viewport -->
 	<meta  name="viewport" content="user-scalable=yes, width=device-width"  />
	
	<link rel="shortcut icon" href="<?php echo bloginfo('template_directory');?>/favicon.ico">
	
	<!-- For iPhone with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo bloginfo('template_directory');?>/apple-touch-icon-114x114-precomposed.png">
	<!-- For first- and second-generation iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo bloginfo('template_directory');?>/apple-touch-icon-72x72-precomposed.png">
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo bloginfo('template_directory');?>/apple-touch-icon-precomposed.png">
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
    <![endif]-->
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">	
	
	<?php wp_head(); ?>
	
	
</head>

<body <?php body_class(); ?>>
<p class="old_ie">Please upgrade your browser.</p>
<p class="js-off">Please enable javascript.</p>
<div id="outer_page_wrap">
<div id="page_wrap" class="clearfix">
  <header id="masthead">
    <hgroup class="gradient">
        <h1 id="site-title" class="hidden"><?php bloginfo('name'); ?></h1>
        <h2 id="site-description" class="hidden"><?php bloginfo('description'); ?></h2>      
        <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/logo.png" alt="" width="100%" height="100%"  /></a>
          
		<?php
		//Grab header options
		$header_options_array = array('rh_phone_number');
		foreach($header_options_array as $option_var) {
			$$option_var = get_theme_mod($option_var);	
		}
		$social_options_array = array('rh_facebook_url','rh_twitter_url');
		foreach($social_options_array as $option_var) {
			$$option_var = get_theme_mod($option_var);	
		}
        ?>
        <div class="utility_wrap">
            <span class="phone"><a href="tel:<?php echo $rh_phone_number; ?>">Call Us: <?php echo $rh_phone_number; ?></a></span>
            <a target="_blank" href="<?php echo $rh_facebook_url ?>" class="social facebook">Facebook</a>
            <a target="_blank" href="<?php echo $rh_twitter_url ?>" class="social twitter">Twitter</a><br />
        	<?php get_search_form(); ?>
        </div><!--#utility_wrap-->
     	<?php include(TEMPLATEPATH . '/inc/mobile_nav.php');?>
    </hgroup>
    <?php include(TEMPLATEPATH . '/inc/main_nav.php');?>

     
  </header>	
	
			