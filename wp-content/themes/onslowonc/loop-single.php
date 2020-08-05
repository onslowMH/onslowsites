<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post();?>
	<?php
	   $post_type = $post->post_type; 
	   $post_type_obj = get_post_type_object($post_type); 
    ?>
	<hgroup class="subhead_wrap">
        <h2><?php echo $post_type_obj->labels->singular_name; ?></h2>
    </hgroup>
    <div class="single_wrap">
		<?php include(TEMPLATEPATH . '/inc/meta.php');?>
        <?php
			if ( has_post_thumbnail()) {
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));
				?>
                <div class="img_wrap">
				<img src="<?php echo $feat_image;?>" width="100%" />
                </div><!--#img_wrap-->
				<?php 
			}
		?>
		<?php the_content();?>
        <hr />
        <?php comments_template('', true ); ?>
	</div><!--#single_wrap-->
	<?php endwhile; ?>
<?php else: ?>
	<h2>No posts found</h2>
<?php endif; ?>