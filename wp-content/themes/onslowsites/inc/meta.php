<div class="meta">
	<?php 
	    global $post;
        $link = get_permalink($post->ID);   
		$header = get_post_meta(get_the_ID(), 'rh_display_title',true);
		if(isset($header)&&!empty($header)) :
         
	?>
    	<h4><a href="<?php echo $link ?>"><?php echo $header ?></a></h4>
    <?php else:?>
        <h4><a href="<?php echo $link ?>"><?php the_title();?></a><br /><small><?php the_time('M j, Y') ?></small></h4>	
    <?php endif;?>
    
	
</div>