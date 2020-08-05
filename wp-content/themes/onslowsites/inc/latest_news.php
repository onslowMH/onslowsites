<div class="latest_news">
<?php
/* 
 * Used to retrieve latest news custom post type posts for our sidebar areas
 */
        /* Query all our posts in default order.
         * 
         */
        global $more;
        $more=0;
        $paged = get_query_var('paged');
        $paged = isset($paged) && !empty($paged) ? $paged : 1;

        $args = array(
            //'paged'=> $paged,//The correct way to invoke pagination if needed
            'posts_per_page' => 2,
            'numberposts' => 2,
            'post_status' => 'publish',
            'post_type' => 'ons_news',
        );
        query_posts($args);
        ?>
        <?php if (!have_posts()) : ?>  
            <h5>No News Found.</h5>
        <?php else: ?>
            
                <h5>Latest News <a href="<?php echo '/' . ONS_News_CPT::$url_slug ?>" class="read_more small">Read all news &raquo;</a></h5>

                <?php while (have_posts()) : the_post(); ?>
                    <div class="post_wrap">
                        <h6><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?><span class="learn_more">&nbsp;&raquo;</span></a></h6>
                        <?php the_content('<span class="read_more">Read more &raquo;</span>'); ?>
                    </div>
                
                <?php endwhile; ?>
            
        <?php endif; ?>
        <?php
        //Reset query
        wp_reset_query();
        ?>
<!--        <h5>Latest News <a href="/news" class="read_more small">Read all news &raquo;</a></h5>




        <div class="post_wrap">
            <h4><a href="#">The Title<span class="learn_more">&nbsp;&raquo;</span></a></h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. <a href="#" class="read_more small">Read more &raquo;</a></p>
        </div>
        <div class="post_wrap">
            <h4><a href="#">The Title<span class="learn_more">&nbsp;&raquo;</span></a></h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>-->

</div>