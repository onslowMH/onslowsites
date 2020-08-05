<?php 
	if( is_tax()):
	
		global $wp_query;
		$term = $wp_query->get_queried_object();
		$title = $term->name;
		$tax_description = $term->description;
		?>
		<hgroup class="subhead_wrap">
			<h1><?php echo $title; ?></h1>
			<h2><?php echo $tax_description; ?></h2>
		</hgroup>
		<?php 	
		
	else:
?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<hgroup class="subhead_wrap">
			<?php 
				$header = get_post_meta(get_the_ID(), 'rh_display_title',true);
				if(isset($header)&&!empty($header)) :
			?>
				<h2><?php echo $header ?></h2>
			<?php else:?>
				<h2><?php the_title();?></h2>	
			<?php endif;?>
            <?php
				if ( has_post_thumbnail()) {
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));
					?>
                    <img src="<?php echo $feat_image;?>" width="100%" />
                    <?php 
			 	}
			?>
		</hgroup>
	<?php endwhile; endif; ?>
<?php endif;?>
