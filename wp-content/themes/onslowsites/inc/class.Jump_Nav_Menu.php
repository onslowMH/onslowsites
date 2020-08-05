<?php

/**
 * Create jump menu form of nav menu items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker
 */
class Jump_Nav_Menu extends Walker_Nav_Menu {

    public $nav_args=array();
    
    
    public function __construct($nav_args=NULL) {
       if(!is_null($nav_args)) {
           $this->nav_args = $nav_args;
       }
        
        
    }
    
    /**
     * Magic __toString.
     * @return string
     */
    function __toString() {
        return $this->display();
    }
    
    /**
     * display Display jump menu navigation
     * @return string
     */
    function display() {
        ob_start();

        $mobile_nav_defaults = array(
            'theme_location' => 'primary-menu',
            'container' => '',
            'after' => '',
            'echo' => false,
            'walker' => new self(),
            'form_class' =>'hidden-lg'
        );
        $jump_nav_args = array_merge($mobile_nav_defaults, $this->nav_args);
        $mobile_menu = wp_nav_menu($jump_nav_args);
        //echo preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $mobile_menu ); 
        ?>
        

            <form name="jump_nav_form" class="rh_jump_nav_form <?php echo isset($this->nav_args['form_class']) && !empty($this->nav_args['form_class']) ? $this->nav_args['form_class'] : '' ?>">
                <select name="url_list" class="jumpmenu <?php echo isset($this->nav_args['menu_class']) && !empty($this->nav_args['menu_class']) ? $this->nav_args['menu_class'] : '' ?>">
                    <?php
                    echo preg_replace(array('#^<ul[^>]*>#', '#</ul>$#'), '', $mobile_menu);
                    ?>
                </select>
            </form>	
        

        <?php
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    

    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    /**
     * @see Walker::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat("-&nbsp;", $depth) : '&nbsp;';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

//$output .= $indent . '<option' . $id . $value . $class_names .'>';
        //$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        //$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        //$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes = isset($item->url) && !empty($item->url) ? ' value="' . esc_attr($item->url) . '"' : '';
        $output .= '<option' . $id . $value . $class_names . $attributes . '>';

        //$item_output = $args->before;
        //$item_output .= '<a'. $attributes .'>';
        $item_output = $indent;
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        //$item_output .= '</a>';
//$item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * @see Walker::end_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     */
    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= "</option>\n";
    }

}
?>