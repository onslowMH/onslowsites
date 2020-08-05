<h4 class="underlined">Our Staff</h4>
<div class="staff_wrapper">
<?php
//Find all of our published staff custom post type items in descending menu_order
$staff = ONS_Staff_CPT::find_all('DESC');
if (isset($staff) && count($staff > 0)) {
    $items = array();
    foreach ($staff as $person) {
        //echo '<tt><pre>' . var_export($person, true) . '</pre></tt>';
        $item = new stdClass();
        if (isset($person->custom_data) && count($person->custom_data) > 0) {
            if (isset($person->post_title)) {
                $item->post_title = $person->post_title;
            } else {
                $item->post_title = false;
            }
            if (isset($person->custom_data['rh_display_title'])) {
                $item->rh_display_title = $person->custom_data['rh_display_title'];
            } else {
                $item->rh_display_title = false;
            }
            if (isset($person->featured_img_src)) {
                $item->featured_img_src = $person->featured_img_src;
            } else {
                $item->featured_img_src = false;
            }
        }
        $items[] = $item;
    }
}
?>
<?php if (count($items) > 0) : ?>
    <?php foreach ($items as $item): ?>

        <div class="staff_wrap">
            <?php if ($item->post_title): ?>
                <h5><?php echo $item->post_title; ?>
                    <?php if ($item->rh_display_title): ?>
                        <br /><small><?php echo $item->rh_display_title; ?></small>
                    <?php endif; ?>
                </h5>
            <?php endif; ?>
            <?php
            if ($item->featured_img_src) {
                ?>
                <div class="img_wrap">
                    <img src="<?php echo $item->featured_img_src; ?>" width="100%" />
                </div><!--#img_wrap-->
                <?php
            }
            ?>       
            <?php the_content('<span class="read_more small">Read more &raquo;</span>'); ?>

        </div><!--#excerpt_wrap-->

    <?php endforeach; ?>


<?php else: ?>
    <h5>No staff found</h5>
<?php endif; ?>
</div>
<!--staff_wrapper-->