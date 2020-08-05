<?php
//Grab footer options
$footer_options_array = array('rh_disclaimers');
foreach ($footer_options_array as $option_var) {
    $$option_var = get_theme_mod($option_var);
}
?>

<footer id="footer"> 
    <?php include(TEMPLATEPATH . '/inc/footer_nav.php'); ?>
    <?php echo $rh_disclaimers; ?> 
    <a class="logo" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/logo_footer.png" alt="" width="100%" height="100%"  /></a> 
</footer>
</div>
<!--#page_wrap-->
</div>
<!--#outer_page_wrap-->

<?php wp_footer(); ?>
	<script>
	jQuery(document).ready(function(){
	var imag_detail = jQuery('img');
	imag_detail.each(function(index){
	jQuery(this).attr("src", jQuery(this).attr("src").replace("http://", "https://"));
	 /*jQuery(this).attr("src", $(this).attr("src").replace("http://", "https://"));*/
	 /*console.log(jQuery(this).attr('src'));*/
	jQuery(this).attr({'srcset':jQuery(this).attr('src')});
	//jQuery(this).attr({'srcset':jQuery(this).attr("src", $(this).attr("src").replace("http://", "https://"))})
	//console.log(varsrcset.src.indexOf("https://"));
	  /*  if (varsrcset.src.indexOf("https://") == -1) {
	        varsrcset.src = location.src.replace("http://", "https://");
	         varsrcset.srcset = location.src.replace("http://", "https://");
	    }else{
	      varsrcset.srcset = location.src.replace("http://", "https://");
	    }*/
	//console.log();
	
	});
	});
	</script>

<!-- Don't forget analytics -->
<?php 
    echo get_theme_mod('rh_analytics_code')
 ?>


</body></html>