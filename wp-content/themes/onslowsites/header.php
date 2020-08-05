<?php 
// Establish mobile version preference boolean for use down the line..
require_once TEMPLATEPATH . '/inc/Mobile_Detect.php';
$detect = new Mobile_Detect();
$layout = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
?>
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
        <meta  name="viewport" content="user-scalable=yes, width=device-width, initial-scale=1.0"  />

        <link rel="shortcut icon" href="<?php echo bloginfo('template_directory'); ?>/favicon.ico">

        <!-- For iPhone with high-resolution Retina display: -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo bloginfo('template_directory'); ?>/apple-touch-icon-114x114-precomposed.png">
        <!-- For first- and second-generation iPad: -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo bloginfo('template_directory'); ?>/apple-touch-icon-72x72-precomposed.png">
        <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
        <link rel="apple-touch-icon-precomposed" href="<?php echo bloginfo('template_directory'); ?>/apple-touch-icon-precomposed.png">

        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">	

        <?php wp_head(); ?>
        <!--[if lt IE 9]>
            <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/lib/respond.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]>
            <style type="text/css">
              .gradient, #main-nav ul li ul li.current_page_item a, nav#main-nav.gradient, nav#main-nav ul li.current_page_item > a, nav#main-nav ul li.current-menu-item > a  {
                 filter: none;
              }
            </style>
        <![endif]-->


    </head>
    <body <?php body_class($layout); ?>>
        <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
           chromium.org/developers/how-tos/chrome-frame-getting-started -->
      <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="https://browsehappy.com/">Upgrade to a different browser</a> or <a href="https://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
        <div class="js-off">
            <p><em>You'll need JavaScript enabled to use this site.</em></p>
        </div> 
        <div class="old_ie">
            <p><em>Please update your browser.</em></p>
        </div>
        <div class="wrapper">        
            <header id="masthead" >
                <div class="banner_wrap">
                    <div id="header_img_wrap">
                        <img id="header_img" width="1500" height="160" src="https://onslowsurgical.onslowsites.com/files/2015/10/cropped-cropped-cropped-masthead_bg2-1024x109.png" />
                    </div>
                    <h1 id="site-title" class="hidden"><?php bloginfo('name'); ?></h1>
                    <a href="<?php echo home_url('/') ?>" class="logo"><img src="<?php echo RH_Theme_Options::getOption('theme_logo_1'); ?>" /></a>
                    <span class="banner_corner visible-lg"></span>
                    <div class="utility_wrap hidden-xs col-xs-5 pull-right">                
                        <div class="contact">
                            <span class="phone small" href="tel:<?php echo RH_Theme_Options::getOption('phone_number'); ?>">Call Us: <?php echo RH_Theme_Options::getOption('phone_number'); ?></span>
                            <div class="social_wrap">
                                <?php
                                $social_post_types = ONS_Social_Media_Post_Type::find_all('DESC');
                                ?>
                                <?php foreach ($social_post_types as $type): ?>
                                    <?php
                                    $link = $type->custom_data['ons_social_media_href'];
                                    $icon_src = $type->custom_data['ons_social_media_icon'];
                                    $label = $type->post_title;
                                    ?>
                                    <a target="_blank" class="social" href="<?php echo $link; ?>"><img src="<?php echo $icon_src; ?>" /></a>
                                <?php endforeach; ?>
                            </div>
                            <!--social_wrap-->
                        </div>
                        <!--contact-->
                        <?php get_search_form(); ?>
                    </div>
                    <!--utility_wrap-->
                </div>
                <!--banner_wrap-->
                <div class="nav_wrap">
                    <div class="row phone hidden-lg">
                        <a class="phone large visible-xs" href="tel:<?php echo RH_Theme_Options::getOption('phone_number'); ?>">Call Us: <?php echo RH_Theme_Options::getOption('phone_number'); ?></a>
                        

                    </div>
                    <nav class="main_nav hidden-lg" role="navigation">
                        <h6 class="hidden">Mobile Navigation</h6>
                        <?php
                        // Our mobile drop-down navigation
                        $mobile_nav_defaults = array(
                            'menu_class' => 'form-control input-sm hidden-lg',
                            'theme_location' => 'primary-menu',
                            'link_before' => '',
                        );
                        $main_nav = new Jump_Nav_Menu($mobile_nav_defaults);
                        echo $main_nav;
                        ?>


                    </nav>

                    <?php include(TEMPLATEPATH . '/inc/main_nav.php'); ?>

                </div>
                <!--nav_wrap-->
            </header>
            <div id="page_wrap" class="clearfix">


