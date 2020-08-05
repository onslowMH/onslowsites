<?php $footer_nav_defaults = array(
	'theme_location'=>'footer-menu',
	'container'       => '', 
	'before'          => '',
	'after'           => '',
	'link_before'     => '<span class="separator">|</span>',
	'link_after'      => '',
	
); ?>

<nav id="footer-nav">
  <h1 class="hidden">Footer Navigation</h1>
  <?php wp_nav_menu($footer_nav_defaults);?>
</nav>
