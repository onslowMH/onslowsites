<?php get_template_part('open','sidebar');?>

    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Default Sidebar Widgets') ) : else : ?>
    
        <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
    <img src="<?php echo get_bloginfo('template_directory'); ?>/images/sidebar_image.png" width="100%"/>
	<?php endif; ?>
	<?php include(TEMPLATEPATH . '/inc/backtotop.php');?>
<?php get_template_part('close','sidebar');?>    
 