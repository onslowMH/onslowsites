<?php get_header(); ?>
<?php
wp_reset_query(); //required for is_page_template to work
$is_homepage = false;
$is_staff_page = false;
$is_archive = false;
$is_single = false;
$is_404 = false;
$is_search = false;
if (is_home() || is_front_page()) {
    $is_homepage = true;
} elseif (is_archive()) {
    $is_archive = true;
} elseif (is_single()) {
    $is_single = true;
} elseif (is_page_template('page_staff.php')) {
    $is_staff_page = true;
} elseif (is_404()) {
    $is_404 = true;
} elseif (is_search()) {
    $is_search = true;
} else {
    //Onward
}
?>
<?php if ($is_homepage): ?>   
    <?php get_template_part('layout', 'homepage') ?>

<?php else: ?>
    <div id="content_wrap" class="clearfix">
        <section>
            <div class="inside">
                <?php if ($is_archive || $is_search): ?>
                    <?php get_template_part('loop', 'archive') ?>
                <?php elseif ($is_single): ?>
                    <?php get_template_part('loop', 'single') ?>
                <?php elseif ($is_404): ?>
                    <h3>Sorry - Page Not Found</h3>
                <?php else: ?>
                    <?php get_template_part('loop') ?>
                    <?php if ($is_staff_page): ?>
                        <?php get_template_part('loop','staff') ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div><!-- end inside -->			
        </section>
        <aside>
            <?php get_sidebar() ?>
        </aside>
    </div> 
    <!--end content_wrap-->
<?php endif; ?>
<?php get_footer() ?>