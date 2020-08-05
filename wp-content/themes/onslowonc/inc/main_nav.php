<?php $main_nav_defaults = array(
	'theme_location'=>'primary-menu',
	'container'       => '', 
	'before'          => '',
	'after'           => '',
	'link_before'     => '<span>',
	'link_after'      => '<span class="child_indicator">&nbsp;&raquo;</span></span>',
	
	
); ?>
<nav id="main-nav" class="clearfix">
  <h1 class="hidden">Main Navigation</h1>
  <?php wp_nav_menu($main_nav_defaults);?>
</nav>
 