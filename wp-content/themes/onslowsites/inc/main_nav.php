<?php $main_nav_defaults = array(
	'theme_location'=>'primary-menu',
        'menu_class'    =>'visible-lg',
	'container'       => '',
    
	'before'          => '',
	'after'           => '',
	'link_before'     => '<span>',
	'link_after'      => '</span>',
	
	
); ?>
<nav id="main-nav" class="clearfix visible-lg gradient">
  <h1 class="hidden">Main Navigation</h1>
  <?php wp_nav_menu($main_nav_defaults);?>
</nav>
 