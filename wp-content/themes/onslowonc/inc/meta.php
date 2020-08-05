<div class="meta">
	<?php 
	    global $post;
        $link = get_permalink($post->ID);   
		$header = get_post_meta(get_the_ID(), 'rh_display_title',true);
		if(isset($header)&&!empty($header)) :
         
	?>
    	<h3><a href="<?php echo $link ?>"><?php echo $header ?></a></h3>
    <?php else:?>
        <h3><a href="<?php echo $link ?>"><?php the_title();?></a></h3>	
    <?php endif;?>
    <?php the_time('M j, Y') ?>
	
</div>