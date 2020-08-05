<?php if (have_posts()) : ?>
    <h3><?php wp_title(''); ?></h3>
    <?php while (have_posts()) : the_post(); ?>
        <div class="excerpt_wrap clearfix">
            <?php include(TEMPLATEPATH . '/inc/meta.php'); ?>
            <?php
            if (has_post_thumbnail()) {
                $feat_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                ?>
                <div class="img_wrap">
                    <img src="<?php echo $feat_image; ?>" width="100%" />
                </div><!--#img_wrap-->
                <?php
            }
            ?>       
            <?php the_content('<span class="read_more small">Read more &raquo;</span>'); ?>

        </div><!--#excerpt_wrap-->
        <hr />

    <?php endwhile; ?>
    <?php include (TEMPLATEPATH . '/inc/pagination_links.php'); ?>

<?php else: ?>
    <h2>No posts found</h2>
<?php endif; ?>