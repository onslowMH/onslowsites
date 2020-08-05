<aside class="clearfix">
    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Homepage Secondary Rail Widgets') ) : else : ?>
<!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
 <?php
 /* Query all our posts in default order.
 * 
 */
 $paged=get_query_var('paged');
 $paged = isset($paged)&&!empty($paged)?$paged:1;

 $args = array(
    //'paged'=> $paged,//The correct way to invoke pagination if needed
    'posts_per_page'=>2,
    'numberposts'=>2,
    'post_status'=>'publish',
    'post_type'=>'ons_news',
                
 );
 query_posts($args);?>
     <?php get_template_part('loop','homepage_news'); ?>
 <?php
     //Reset query
     wp_reset_query();
 ?>            
 
        
		<!-- 
<div class="widget">
	<h3>Latest News</h3>
	<a href="#" class="read_all">Read all news &raquo;</a>
	
	<h4>Lorem ipsum dolor sit amet, consectetur adipiscing.</h4>
    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. <a class="read_more" href="#">Read more &raquo;</a></p>
</div>
<div class="widget">
	<h3>Latest Blog Post</h3>
	<a href="#" class="read_all">Read all posts &raquo;</a>
	<h4>Lorem ipsum dolor sit amet, consectetur adipiscing.</h4>
    <p>Aenean ultricies mi vitae est. Mauris placerat eleifend leo. <a class="read_more" href="#">Read more &raquo;</a></p>
</div> -->
<?php include(TEMPLATEPATH . '/inc/backtotop.php');?>

   
	<?php endif; ?>
</aside>