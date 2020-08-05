<?php
/**
 * Displays Twitter Bootstrap Carousel markup
 * Usage: 
 *  Place the following in your scripts file: 
 *  if(jQuery("#myCarousel").length>0) {
        jQuery('#myCarousel').carousel({
        interval: 8000

        });
    }
 *  Then call the following in your php
 *      $carousel = new RH_Bootstrap_Carousel();
  echo $carousel;
 *
 * @author Darwin Hadley
 */
if (class_exists('ONS_Bootstrap_Carousel') != true) {

    class ONS_Bootstrap_Carousel extends RH_Bootstrap_Carousel {

        

        /**
         * Constructor.
         * @param array $items An array of objects containing slide details
         */
        public function __construct($items = NULL) {
            parent::__construct($items);
         
        }

        /*
         * buildPlaceholderItems Builds FPO list of slide objects
         */

        protected function buildPlaceholderItems($numItems = 5) {
            for ($i = 0; $i < $numItems; $i++) {
                $item = new stdClass();
                $item->src = 'holder.js/1000x563/auto';
                $item->heading = 'Assurance begins with understanding<span class="punctuation">.</span><span class="learn_more">&nbsp;&raquo;</span>';
                $item->caption = 'Get a handle on the common urological issues men and women face. <a href="#" class="learn_more">Learn more &raquo;</a>';
                $item->href = "#";
                $this->items[] = $item;
            }
        }

       

        /**
         * Display carousel
         * Override to alter display
         * @return string
         */
        protected function display() {
            ob_start();
            ?>
            <!--Carousel-->
            <div id="myCarousel" class="carousel slide">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php for ($i = 0; $i < count($this->items); $i++): ?>
                        <li data-target="#myCarousel" data-slide-to="<?php echo $i ?>" <?php echo $i < 1 ? 'class="active"' : ''; ?>></li>
                    <?php endfor; ?>
                </ol><!--carousel indicators-->
                <!--Wrapper for slides-->

                <div class="carousel-inner">
                    <?php for ($i = 0; $i < count($this->items); $i++): ?>
                        <?php $item = $this->items[$i] ?>
                    <div class="item <?php echo $i < 1 ? 'active' : '' ?>"><a href="<?php echo $item->href ?>"><img width="100%" src="<?php echo $item->src?>" alt="<?php echo esc_attr($item->heading) ?>"/></a><div class="carousel-caption"><h2><?php echo isset($item->heading) ? $item->heading : '' ?></h2><p><?php echo isset($item->caption) ? $item->caption : '' ?></p></div></div>
                    <?php endfor; ?>

                </div><!--carousel-inner-->
                <!--Controls-->
                <a href="#myCarousel" class="left carousel-control" data-slide="prev"><span class="left-caret"></span></a>
                <a href="#myCarousel" class="right carousel-control" data-slide="next"><span class="right-caret"></span></a>
            </div>
            <!--end Carousel-->
            <?php
            $contents = ob_get_contents();
            ob_end_clean();
            return $contents;
        }

    }

//endclass
}//endif
