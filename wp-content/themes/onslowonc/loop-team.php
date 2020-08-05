<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php
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
<?php endwhile; endif; ?>