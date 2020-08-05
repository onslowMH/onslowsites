<?php 
//Set up our shortcode	
	
if( !function_exists('ons_output_map') ) {
	function ons_output_map($atts)
	{
	           
	    extract( shortcode_atts( array(
            'address' => '317 Western Blvd.',
            'city' => 'Jacksonville',
            'state' => 'TN',
            'map_height' =>240,
            'map_width'=>320,
            
        ), $atts ) );
		ob_start();
		  echo rh_static_map($address,$city,$state,$map_height,$map_width);
		$html = ob_get_contents();
		ob_end_clean();
		
		return $html; 
					
	}//end function
}//end function exists

add_shortcode ('ons_map', 'ons_output_map');


/*************************************************************
 * 
 * The following shortcode returns recent posts by post type in a on line link format suitable for sidebar
 * [ons_recent_posts post_type='ons_news']
 * 
 * ***************************************************/

if(!function_exists('ons_recent_posts_cb')) {
    function ons_recent_posts_cb($atts) {
        extract( shortcode_atts( array(
            'post_type' => 'ons_news',
            
            
        ), $atts ) );
        
        ob_start();
          
         /* Query all our posts in default order.
         * 
         */
         $paged=get_query_var('paged');
         $paged = isset($paged)&&!empty($paged)?$paged:1;
        
         $args = array(
            //'paged'=> $paged,//The correct way to invoke pagination if needed
            'posts_per_page'=>10,
            
            'post_status'=>'publish',
            'post_type'=>$post_type,
                         
         );
         query_posts($args);?>
         <?php
         // Begin Loop
            if ( !have_posts() ) : ?>  
                <h2>No Recent Posts Found.</h2>
            <?php else: ?>
                <?php while (have_posts()) : the_post(); ?>
                    <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a><br />
                          
                <?php endwhile; ?>
               
            <?php endif; ?>
         <?php //End Loop
         //Reset query
         wp_reset_query();
        //Now return contents
        $html = ob_get_contents();
        ob_end_clean();
        
        return $html;            
        
        
    }//end function
  
}//end if function exists
add_shortcode ('ons_recent_posts', 'ons_recent_posts_cb');  
?>