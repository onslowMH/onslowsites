<div class="inside">
    <?php if (is_active_sidebar('primary')) : ?>
        <?php dynamic_sidebar('primary'); ?>
    <?php else : ?>
        <div id="widget_sp_image-1" class="widget widget_sp_image">
            <a class="widget_sp_image-image-link" href="http://redhammerworks.com" target="_self">
                <img data-src="holder.js/210x80/auto">
            </a>
            <h5>
                <a href="http://redhammerworks.com" target="_self">Our Staff &raquo;</a>
            </h5>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. <a href="#" class="read_more">Learn More &raquo;</a></p>
        </div>
        <div id="widget_sp_image-2" class="widget widget_sp_image">
            <a class="widget_sp_image-image-link" href="http://redhammerworks.com" target="_self">
                <img data-src="holder.js/210x80/auto">
            </a>
            <h5>
                <a href="http://redhammerworks.com" target="_self">FAQ's About Urology &raquo;</a>
            </h5>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. <a href="#" class="read_more">Learn More &raquo;</a></p>
        </div>
        <div id="widget_sp_image-3" class="widget widget_sp_image">
            <a class="widget_sp_image-image-link" href="http://redhammerworks.com" target="_self">
                <img data-src="holder.js/210x80/auto">
            </a>
            <h5>
                <a href="http://redhammerworks.com" target="_self">PSA Screening Guidelines &raquo;</a>
            </h5>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. <a href="#" class="read_more">Learn More &raquo;</a></p>
        </div>
    <?php endif; ?>
    <?php
    if (!is_home() && !is_front_page()) {
        include TEMPLATEPATH . '/inc/latest_news.php';
    }
    ?>
</div>
<!--inside-->
