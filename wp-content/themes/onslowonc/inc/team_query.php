<?php
    global $post;
    $tmp_post = $post;
	//Get the most recent post in the featured posts category.
	$team_args = array( 
		'numberposts' => -1,
		'posts_per_page' => -1, 
		'post_type' => 'ons_staff_cpt',
		'order'=>'ASC',
		'orderby'=>'menu_order'
		);
	$posts_array = get_posts( $team_args );
	foreach ($posts_array as $post) {
		setup_postdata($post);
        $custom_fields = get_post_custom(get_the_ID());
        $fieldnames = array('rh_display_name','rh_display_title');
        foreach($fieldnames as $fieldname) {
            $my_custom_field = $custom_fields[$fieldname];
            foreach ( $my_custom_field as $key => $value ) {
                $$fieldname = $value;
            }
        }    
        ?>
        <div class="team_member_wrap">
            <hgroup>
                <h5><?php echo $rh_display_name;  ?></h5>
                <h6><?php echo $rh_display_title;  ?></h6>
            </hgroup>
         <?php
            if ( has_post_thumbnail()) {
                $feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));
                ?>
                <div class="img_wrap">
                    <figcaption>
                        
                    </figcaption>
                    <img src="<?php echo $feat_image;?>" width="100%" />
                </div>    
                <?php 
            }
        ?>
        </div><!--#team_member_wrap-->
        <?php
	}//end foreach
	$post = $tmp_post;
    
?>