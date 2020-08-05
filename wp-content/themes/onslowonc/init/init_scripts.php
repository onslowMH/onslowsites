<?php
//Wordpress Recent Comments widget injects an inline style in the header. We remove it here
//and put it in styles.css
//From code.trac.wordpress.org/ticket/11928
function rh_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'],'recent_comments_style'));	
}
add_action('widgets_init','rh_remove_recent_comments_style');


function rh_initialize_scripts_and_styles() {
	if (!is_admin()) {
		
		add_action('wp_enqueue_scripts', 'rh_load_my_scripts_method');
		function rh_load_my_scripts_method(){
			//Modernizr in head. All other in footer for faster loading
			$rh_modernizr =	get_bloginfo('template_url') . '/js/modernizr.js';
			wp_register_script('rh_modernizr',$rh_modernizr);
			wp_enqueue_script( 'rh_modernizr' );
						
			//Jquery and all other in footer per html5 boilerplate
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', NULL, '1.7.2', true);
			wp_enqueue_script( 'jquery' );
			
			//Our javascripts plugins file
			$rh_plugins_scripts =	get_bloginfo('template_url') . '/js/plugins.js';
			wp_register_script( 'rh_plugins_scripts',$rh_plugins_scripts, array('jquery'), NULL, true);
			wp_enqueue_script( 'rh_plugins_scripts' );
			
			//Our general applications javascripts file
			$rh_general_scripts =	get_bloginfo('template_url') . '/js/scripts.js';
			wp_register_script( 'rh_general_scripts',$rh_general_scripts, array('jquery','rh_plugins_scripts'), NULL, true);
			wp_enqueue_script( 'rh_general_scripts' );
			
			 //Google webfont config script
			$rh_webfont_config =	get_bloginfo('template_url') . '/js/web_font_config.js';
			wp_register_script('rh_webfont_config',$rh_webfont_config,array('jquery'), NULL,true);
			wp_enqueue_script( 'rh_webfont_config' ); 
			
			 //Google webfont loader api
		   wp_register_script('webfont_loader', ("https://ajax.googleapis.com/ajax/libs/webfont/1.0.26/webfont.js"), array('rh_webfont_config'), false,true);
		   wp_enqueue_script('webfont_loader');
		   
			// Some scripts have to be in the header to work
			//swfobject
			wp_enqueue_script('swfobject');
			
			
			/***************************************
			* Load Stylesheets
			****************************************/
			//Style overrides for jquery ui dialog
			//wp_enqueue_style( 'wp-jquery-ui-dialog');
			//	$rh_dialog_style_overrides = get_bloginfo('template_url') . '/css/rh_dialog_overrides.css';
			//	wp_register_style('rh_dialog_style_overrides', $rh_dialog_style_overrides, 'wp-jquery-ui-dialog' );
			//	wp_enqueue_style( 'rh_dialog_style_overrides');
							
			
		}//rh_load_my_scripts_method
		
		
		// Enqueue other scripts in footer
		function rh_footer_scripts() {
			//We need to include this standard WP script for comments
			if ( is_singular() ) wp_enqueue_script('comment-reply');
			?>
			
			<?php 
			
		}//rh_footer_scripts
		add_action('wp_footer', 'rh_footer_scripts');
	
	}//end if admin
}//rh_initialize_scripts_and_styles
	
add_action('init', 'rh_initialize_scripts_and_styles');

?>