<?php
/*
 * Homepage layout
 */
//Find all of our published slide custom post type items in descending menu_order
$slides = ONS_Slide_Custom_Post_Type::find_all('DESC');
if (isset($slides) && count($slides > 0)) {
    $items = array();
    foreach ($slides as $slide) {
        //echo '<tt><pre>' . var_export($slide, true) . '</pre></tt>';
        $item = new stdClass();
        if (isset($slide->custom_data) && count($slide->custom_data) > 0) {
            if (isset($slide->custom_data['ons_slide_image'])) {
                $item->src = $slide->custom_data['ons_slide_image'];
            }
            if (isset($slide->custom_data['ons_slide_heading'])) {
                $item->heading = $slide->custom_data['ons_slide_heading'];
                $item->heading .= '<span class="punctuation">.</span><span class="learn_more">&nbsp;&raquo;</span>';
            }

        // moved this code above the anchor tag line
            if (isset($slide->custom_data['ons_slide_href'])) {
                $item->href = $slide->custom_data['ons_slide_href'];
            } else {
                $item->href = "#";
            }

        // Now concatenate $item->href in the anchor tag line
            if (isset($slide->custom_data['ons_slide_caption'])) {
                $item->caption = $slide->custom_data['ons_slide_caption'];
                $item->caption .= '&nbsp;<a href="' . $item->href . '" class="learn_more">Learn more &raquo;</a>';

            }
        }

        $items[] = $item;
    }
    $carousel = new ONS_Bootstrap_Carousel($items);
    echo $carousel;
}
?>
<div id="content_wrap" class="clearfix homepage">
    <section id="homepage_section">

        <?php get_sidebar() ?>

    </section>
    <?php get_sidebar('homepage_secondary_rail') ?>
</div> 
<!--end content_wrap-->

