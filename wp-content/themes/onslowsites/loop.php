<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php
        if (is_tax()):

            global $wp_query;
            $term = $wp_query->get_queried_object();
            $title = $term->name;
            $tax_description = $term->description;
            ?>
            <hgroup class="subhead_wrap">
                <h3><?php echo $title; ?></h3>
                <h4><?php echo $tax_description; ?></h4>
            </hgroup>
            <?php
        elseif (is_page()):
            ?>
            <?php
            $header = RH_Custom_Page_Headings::getDisplayTitle();
            ?>
            <h3><?php echo $header ?></h3>

        <?php else: ?>
            <h3><?php the_title(); ?></h3>
        <?php endif; ?>
        <?php
        $src = rh_get_featured_image_src($post->ID);
        if ($src):
            ?>
            <div id="featured_img_wrap">

                <img class="featured_img" width="100%" src="<?php echo rh_get_featured_image_src($post->ID); ?>" />


            </div>
        <?php endif; ?>
        <!--header_img_wrap-->
        <?php the_content(); ?>

        <?php
    endwhile;
endif;
?>