<div class="flexslider">
  <ul class="slides">
     <?php 
        $slides = rh_find_all_by_post_type('ons_slide_cpt');
        if($slides) {
            foreach( $slides as $slide ) : setup_postdata($slide);
                //Check for url
                $href = get_post_meta($slide->ID, 'rh_slide_url', true);
                if(rh_isset($href)):?>
                    <li>
                      <a href="<?php echo $href; ?>"><img src="<?php echo rh_get_featured_image_src($slide->ID); ?>" /></a>
                    </li>
                <?php else:?>
                     <li>
                      <img src="<?php echo rh_get_featured_image_src($slide->ID); ?>" />
                    </li>
                <?php endif; ?>
            <?php endforeach; 
        } else {
            ?>
            <li>No slides found</li>
            <?php
            
        } 
    ?>

    
    
    
  </ul>
</div>