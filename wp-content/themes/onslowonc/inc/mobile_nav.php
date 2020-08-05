<?php 
 
	$mobile_nav_defaults = array(
	'theme_location'=>'mobile-primary-menu',
	'container'       => '',
	'before'          => '',
	'after'           => '',
	'echo'				=>false,
	'walker' => new Jump_Nav_Menu(),
	);
	$mobile_menu = wp_nav_menu($mobile_nav_defaults);
	//echo preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $mobile_menu ); 
?>
<nav id="mobile-nav" class="device_only">
	
	<form name="form1" id="form1">
		<select name="url_list" class="jumpmenu">
		<?php
			echo preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $mobile_menu );
		?>
		</select>
	</form>	
</nav>