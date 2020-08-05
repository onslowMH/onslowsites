<?php
//include(WP_PLUGIN_DIR . '/rh_members_only/session.php');
include(TEMPLATEPATH . '/init/theme_custom_post_types/rh_custom_post_types.php');
include(TEMPLATEPATH . '/init/theme_custom_fields/rh_custom_fields.php');
include(TEMPLATEPATH . '/init/theme_options.php');
include(TEMPLATEPATH . '/init/shortcodes.php');
include(TEMPLATEPATH . '/init/init_scripts.php');  
include(TEMPLATEPATH . '/init/init_nav_menus.php');
include(TEMPLATEPATH . '/init/init_sidebars.php');
include(TEMPLATEPATH . '/init/helpers.php');
include(TEMPLATEPATH . '/init/custom_image_sizes.php');
include(TEMPLATEPATH . '/init/walkers.php');

	//Add custom post types to archives
	function namespace_add_custom_types( $query ) {
      // if(!is_admin()) {
            // /*
            // if ht_news is already in the $post_types array then this function has probably already been executed
            // and we don't want to run it again, because that makes all our widgets display ht_news instead 
            // of their own post type
            // */
            // // $post_types = get_query_var('post_type');
            // // if(in_array('ht_news',$post_types)) {
                // // $post_type = 'ht_news';
            // // }
            // if ( !is_page() &&  $query->is_archive() ) {
                // $query->set('post_type',array('post','ons_news','nav_menu_item') );
                // return $query;
            // }
        // }
        $post_types = get_query_var('post_type');
                 
         if (!is_page()&& !is_tag() && !is_post_type_archive('ons_news') && !is_post_type_archive('ons_staff_cpt') && is_archive() && $query->is_archive() ) {
                $query->set('post_type',array('post','ons_news') );
                return $query;
            }
        
       
    }
    if(!is_admin()) {        
        add_filter( 'pre_get_posts', 'namespace_add_custom_types' );
    }
	
	
	//Demote the WordPress SEO meta box
    function rh_demote_wpseo_meta_box() {
       return 'low'; 
    }
    add_filter( 'wpseo_metabox_prio', 'rh_demote_wpseo_meta_box');
	
	//So shortcodes will work in our sidebar widgets
	add_filter('widget_text','do_shortcode');
	
	// Automatically append .video class to oembed content (not a perfect solution, but close)
	//This supports use of fitvids javascript for responsive video
	function rh_fitvids_embed_filter( $html, $data, $url ) {
	
		$return = '<div class="video">'.$html.'</div>';
		return $return;
	}
	add_filter('oembed_dataparse', 'rh_fitvids_embed_filter', 90, 3 ); 
 
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator'); 
	
	/****************************************
	* Login page logo
	*/
	
	//WordPress Change Login page logo link
	function change_login_page_url($url) {
		return get_bloginfo('url');	
	}
	add_filter( 'login_headerurl', 'change_login_page_url' );
	
	// custom admin login logo
	function custom_login_logo() {
		
		ob_start();
		?>		
		
		<style type="text/css">
		.login h1 a {
			margin:0 auto;	
			background-size:auto; 
			background-image: url(<?php echo get_bloginfo('template_directory'); ?>/images/logo-login.png) !important;
			width: 331px;
			height: 44px;
		}
		</style>
		<?php 
		$html = ob_get_contents();
		ob_end_clean();
		echo $html; 
	}
	add_action('login_head', 'custom_login_logo');
	
	/****************************************
	* Remove annoying image title on mouseover
	*/
	add_filter('wp_get_attachment_image_attributes', 'rh_remove_image_text');
	function rh_remove_image_text($attr) {
		unset($attr['title']);
		return $attr;	
	}
	
	/****************************************
	* Customize Excerpts
	*/
	//Customize the excerpt
	function bt_excerpt_length( $length ) {
		return 30;
	}
	add_filter( 'excerpt_length', 'bt_excerpt_length', 999 );
    	
	//Customize the excerpt 'More' text
	function rh_excerpt_more($excerpt) {
		global $post;
		return '...<p class="read_more"><a class="read_more" href="' . get_permalink() . '">Read Full Post &raquo;</a></p>';	
	}
	add_filter('excerpt_more','rh_excerpt_more');
	
	//Customize excerpt ellipsis
	// function rh_excerpt_ellipsis($excerpt) {
		// global $post;
		// //return '<a href=' . get_permalink($post->ID) . '">Read More &gt;</a>';
		// return str_replace('[...]', '...', $excerpt);		
	// }
	// add_filter('excerpt_more','rh_excerpt_ellipsis');

	
?>
