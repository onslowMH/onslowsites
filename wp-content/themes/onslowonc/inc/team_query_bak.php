<?php
    global $wp_query; 
	$original_query = $wp_query;
	$wp_query = NULL;
	//Get the most recent post in the featured posts category.
	$team_args = array( 
		'numberposts' => -1, 
		'post_type' => 'ons_staff_cpt',
		'order'=>'ASC',
		'orderby'=>'menu_order'
		);
	$wp_query = new WP_Query( $team_args );
	
	get_template_part('loop','team');
	
	$wp_query = NULL;
	$wp_query = $original_query;
	wp_reset_postdata();
    
?>