</div>
<!--page_wrap-->
<footer id="footer">
    <?php
    $footer_nav_defaults = array(
        'theme_location' => 'secondary-menu',
        'menu_class' => '',
        'container' => '',
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
    );
    ?>
    <nav id="footer-nav" class="clearfix">
        <h1 class="hidden">Footer Navigation</h1>
        <?php wp_nav_menu($footer_nav_defaults); ?>
    </nav>
    <?php
    $social_post_types = ONS_Social_Media_Post_Type::find_all('DESC');
    ?>
    <div class="social_wrap">
        <?php foreach ($social_post_types as $type): ?>
            <?php
            $link = $type->custom_data['ons_social_media_href'];
            $icon_src = $type->custom_data['ons_social_media_icon'];
            $label = $type->post_title;
            ?>
            <a target="_blank" class="social" href="<?php echo $link; ?>"><img src="<?php echo $icon_src; ?>" /></a>
        <?php endforeach; ?>
    </div>
    <div class="disclaimer_wrap">
        <h5 class="large"><?php echo RH_Theme_Options::getOption('disclaimer_1'); ?></h5>
        <small><?php echo RH_Theme_Options::getOption('disclaimer_2'); ?></small>
    </div>
    <div class="contact_info_wrap clearfix hidden-lg">
        <?php
        $address = new RH_Address(0, false);
        echo $address;
        ?>
        <a class="visible-xs" href="tel:<?php echo RH_Theme_Options::getOption('phone_number'); ?>"><?php echo RH_Theme_Options::getOption('phone_number'); ?></a><br />
        <small><?php echo RH_Theme_Options::getOption('copyright_notice'); ?></small>
    </div>
    <div class="contact_info_wrap clearfix visible-lg">
        <?php
        $address = new RH_Address(1, false);
        echo $address;
        ?>
        <small><?php echo RH_Theme_Options::getOption('copyright_notice'); ?></small>
    </div>

    <!--contact_info_wrap-->
    <div class="logo_wrap clearfix">
        <div class="logo logo_footer">                
            <img width="100%" src="<?php echo RH_Theme_Options::getOption('theme_logo_2'); ?>" />
        </div>

        <div class="logo logo_onslow">                
            <img width="100%" src="<?php echo RH_Theme_Options::getOption('theme_logo_3'); ?>" />
        </div>
    </div>

</footer>

</div>
<!--wrapper-->
<div class="back_to_top" ><button type="button" class="btn btn-link"><span>Back To Top</span>&nbsp;<span class="up-caret"></span></button></div>
        <?php wp_footer(); ?>

<!-- Don't forget analytics -->
<?php echo RH_Theme_Options::getOption('analytics_code'); ?>
</body>

</html>
