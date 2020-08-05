<?php if ( !have_posts() ) : ?>  
    <h2>No News Found.</h2>
<?php else: ?>
    <div class="news_wrap widget">
        <h3>Latest News</h3>
        <a href="/news" class="read_all">Read all news &raquo;</a>
    
    <?php while (have_posts()) : the_post(); ?>
       
        <h4 class="device_only"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?>&nbsp;&raquo;</a></h4>
        <h4><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
        <?php the_excerpt(); ?>
    <?php endwhile; ?>
   </div> 
<?php endif; ?>