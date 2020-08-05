<?php

/**
 * Our theme's functions.php file customized for Onslow Sites
 * This theme utilizes the Red Hammer Core Framework. A framework of methods and classes
 * to speed custom theme development.
 * v1.0.0
 */
/**
 * Initialize the Red Hammer Core Framework. This must occur at the top of the subject theme's functions.php file.
 */
include (WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'redhammercoreframework' . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'init_framework.php');

/* * *********************************************************************************************
 *
 * Subject Theme Customizations. The following settings are typically unique for a given theme.
 *
 * ********************************************************************************************** */
/**
 * Establish custom fields, taxonomies, and post types. Comment out if none or re-declare methods in child themes to override.
 */
add_action('after_setup_theme', 'rh_init_custom_post_types', 10);
if (!function_exists('rh_init_custom_post_types')) {

    function rh_init_custom_post_types() {
        // Initialize Custom Post Types
        $social_media_cpt = new ONS_Social_Media_Post_Type();
        $social_media_cpt->init();
        $slide_cpt = new ONS_Slide_Custom_Post_Type();
        $slide_cpt->init();
        $news_cpt = new ONS_News_CPT();
        $news_cpt->init();
        $staff_cpt = new ONS_Staff_CPT();
        $staff_cpt->init();
    }

}
add_action('after_setup_theme', 'rh_init_custom_taxonomy', 15);
if (!function_exists('rh_init_custom_taxonomy')) {

    function rh_init_custom_taxonomy() {
        //new RH_Sample_Custom_Taxonomy();
    }

}
add_action('after_setup_theme', 'rh_init_custom_fields', 20);
if (!function_exists('rh_init_custom_fields')) {

    function rh_init_custom_fields() {
        //new RH_Sample_Meta_Box();
    }

}


/**
 * Custom theme shortcodes. Comment out if none.
 */
include (get_stylesheet_directory() . '/inc/shortcodes.php');

/**
 * Establish custom widget zones for this theme
 */
$rh_theme_config->setWidgetZoneDefaults(
        array(
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        )
);
$my_sidebars = array(
    array(
        'id' => 'primary',
    )
);
$rh_theme_config->setWidgetZones($my_sidebars);

/**
 * Establish custom nav zones
 */
$my_nav_menus = array(
    'primary-menu' => 'Primary Menu',
    'secondary-menu' => 'Secondary Menu'
);
//Uses WP register_nav_menus to create theme navigation
$rh_theme_config->setNavZones($my_nav_menus);

/**
 * Customize admin login logo
 */
$loginLogo = new RH_LogoLogin(
        array(
    'height' => '44px',
    'width' => '331px',
    'filename' => 'logo-login.png'
        )
);






/**
 * If the theme requires custom images sizes, add them here.
 */
//add_image_size( 'lc_product_package_image', 200, 9999 ); //300 pixels wide (and unlimited height)

/**
 * Customize Excerpts if WordPress excerpts are used in theme.
 * If only the <!--more--> tag is used, or no excerpts are used, this can be commented out
 */
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );
// if (!function_exists('rh_excerpt_length')) {
// /**
// * Customize excerpt string length
// * @param int $length
// * @return int
// */
// function rh_excerpt_length($length) {
// return 30;
// }
//
// }
// add_filter('excerpt_length', 'rh_excerpt_length', 999);
//
// if (!function_exists('rh_excerpt_more')) {
// /**
// * Customize the excerpt 'More' text.
// * @param string $excerpt
// * @return string
// */
// function rh_excerpt_more($excerpt) {
// global $post;
// //return '<a href=' . get_permalink($post->ID) . '">Read More &gt;</a>';
// //return str_replace('[...]', '...', $excerpt);
// return '...<br /><a class="read_more" href="' . get_permalink() . '">Read More &gt;</a>';
// }
//
// }
// add_filter('excerpt_more', 'rh_excerpt_more');

/**
 * If you are using the <!--more--> tag in lieu of the_excerpt and want to customize the link
 */
//function my_more_link($more_link, $more_link_text) {
//    global $post;
//    return '<a class="btn btn-primary btn-sm" href="' . get_permalink($post->ID) . '">Read More &raquo;</a>';
//}
//add_filter('the_content_more_link', 'my_more_link', 10, 2);

/**
 * And if the theme requires additional theme options:
 */
/**
 * Use Built-in WordPress get_header_image() method to retrieve the header image source
 */
//$customHeaderDefaults = array(
//        'default-image'          => '',
//        'random-default'         => false,
//        'width'                  => 0,
//        'height'                 => 0,
//        'flex-height'            => false,
//        'flex-width'             => false,
//        'default-text-color'     => '',
//        'header-text'            => true,
//        'uploads'                => true,
//        'wp-head-callback'       => '',
//        'admin-head-callback'    => '',
//        'admin-preview-callback' => '',
//);
//add_theme_support( 'custom-header', $customHeaderDefaults  );



/**
 * Initialize theme specific scripts
 */
//function rh_load_theme_scripts_method() {
//    
//    //Our general applications javascripts file
//    wp_register_script('rh_bootstap', get_stylesheet_directory_uri() . '/js/lib/bootstrap.min.js', array('jquery', 'backbone'), NULL, true);
//    wp_enqueue_script('rh_bootstap');
//
//}
//add_action('wp_enqueue_scripts', 'rh_load_theme_scripts_method' );

/**
 * Add current_page_active class to our links to archive pages
 */
//function additional_active_item_classes($classes = array(), $menu_item = false){
//    global $wp_query;    
//    if ( strcasecmp($menu_item->post_name,'work')==0 && is_page_template('archive.php') ) {
//        $classes[] = 'current-menu-item';        
//    }
//
//    return $classes;
//}
//add_filter( 'nav_menu_css_class', 'additional_active_item_classes', 10, 2 );
?>
