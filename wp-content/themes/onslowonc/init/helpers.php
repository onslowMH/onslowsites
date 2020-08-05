<?php
/*****************************
 * 
 * This modifies the built in WordPress wp_get_archives method to allow us to present
 * custom post types in our archives sidebar widget.
 * 
 * *********************************************************/
if(!function_exists('wp_get_post_type_archives')) { 
    function wp_get_post_type_archives($args = '') {
        global $wpdb, $wp_locale;
        $defaults = array(
            'type' => 'monthly', 'limit' => '',
            'format' => 'html', 'before' => '',
            'after' => '', 'show_post_count' => false,
            'echo' => 1, 'order' => 'DESC',
        );
    
        $r = wp_parse_args( $args, $defaults );
        extract( $r, EXTR_SKIP );
    
        if ( '' == $type )
            $type = 'monthly';
    
        if ( '' != $limit ) {
            $limit = absint($limit);
            $limit = ' LIMIT '.$limit;
        }
    
        $order = strtoupper( $order );
        if ( $order !== 'ASC' )
            $order = 'DESC';
    
        // this is what will separate dates on weekly archive links
        $archive_week_separator = '&#8211;';
    
        // over-ride general date format ? 0 = no: use the date format set in Options, 1 = yes: over-ride
        $archive_date_format_over_ride = 0;
    
        // options for daily archive (only if you over-ride the general date format)
        $archive_day_date_format = 'Y/m/d';
    
        // options for weekly archive (only if you over-ride the general date format)
        $archive_week_start_date_format = 'Y/m/d';
        $archive_week_end_date_format   = 'Y/m/d';
    
        if ( !$archive_date_format_over_ride ) {
            $archive_day_date_format = get_option('date_format');
            $archive_week_start_date_format = get_option('date_format');
            $archive_week_end_date_format = get_option('date_format');
        }
    
        //filters
        //$where = apply_filters( 'getarchives_where', "WHERE post_type = 'post' OR post_type = 'ons_news' AND post_status = 'publish'", $r );
        $where = apply_filters( 'getarchives_where', "WHERE post_type = 'ons_news' AND post_status = 'publish'", $r );
        $join = apply_filters( 'getarchives_join', '', $r );
    
        $output = '';
    
        if ( 'monthly' == $type ) {
            
            $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date $order $limit";
            
            $key = md5($query);
            $cache = wp_cache_get( 'wp_get_archives' , 'general');
            if ( !isset( $cache[ $key ] ) ) {
                $arcresults = $wpdb->get_results($query);
                $cache[ $key ] = $arcresults;
                wp_cache_set( 'wp_get_post_type_archives', $cache, 'general' );
            } else {
                $arcresults = $cache[ $key ];
            }
            if ( $arcresults ) {
                
                $afterafter = $after;
                foreach ( (array) $arcresults as $arcresult ) {
                    echo '<tt><pre>'.var_export($arcresult,true).'</pre></tt>';
                    $url = get_month_link( $arcresult->year, $arcresult->month );
                    /* translators: 1: month name, 2: 4-digit year */
                    $text = sprintf(__('%1$s %2$d'), $wp_locale->get_month($arcresult->month), $arcresult->year);
                    if ( $show_post_count )
                        $after = '&nbsp;('.$arcresult->posts.')' . $afterafter;
                    if($arcresult->posts>0) {
                        
                        $output .= get_archives_link($url, $text, $format, $before, $after);
                    }
                }
            }
        } elseif ('yearly' == $type) {
            $query = "SELECT YEAR(post_date) AS `year`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date $order $limit";
            $key = md5($query);
            $cache = wp_cache_get( 'wp_get_post_type_archives' , 'general');
            if ( !isset( $cache[ $key ] ) ) {
                $arcresults = $wpdb->get_results($query);
                $cache[ $key ] = $arcresults;
                wp_cache_set( 'wp_get_post_type_archives', $cache, 'general' );
            } else {
                $arcresults = $cache[ $key ];
            }
            if ($arcresults) {
                $afterafter = $after;
                foreach ( (array) $arcresults as $arcresult) {
                    $url = get_year_link($arcresult->year);
                    $text = sprintf('%d', $arcresult->year);
                    if ($show_post_count)
                        $after = '&nbsp;('.$arcresult->posts.')' . $afterafter;
                    $output .= get_archives_link($url, $text, $format, $before, $after);
                }
            }
        } elseif ( 'daily' == $type ) {
            $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, DAYOFMONTH(post_date) AS `dayofmonth`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date), DAYOFMONTH(post_date) ORDER BY post_date $order $limit";
            $key = md5($query);
            $cache = wp_cache_get( 'wp_get_post_type_archives' , 'general');
            if ( !isset( $cache[ $key ] ) ) {
                $arcresults = $wpdb->get_results($query);
                $cache[ $key ] = $arcresults;
                wp_cache_set( 'wp_get_post_type_archives', $cache, 'general' );
            } else {
                $arcresults = $cache[ $key ];
            }
            if ( $arcresults ) {
                $afterafter = $after;
                foreach ( (array) $arcresults as $arcresult ) {
                    $url    = get_day_link($arcresult->year, $arcresult->month, $arcresult->dayofmonth);
                    $date = sprintf('%1$d-%2$02d-%3$02d 00:00:00', $arcresult->year, $arcresult->month, $arcresult->dayofmonth);
                    $text = mysql2date($archive_day_date_format, $date);
                    if ($show_post_count)
                        $after = '&nbsp;('.$arcresult->posts.')'.$afterafter;
                    $output .= get_archives_link($url, $text, $format, $before, $after);
                }
            }
        } elseif ( 'weekly' == $type ) {
            $week = _wp_mysql_week( '`post_date`' );
            $query = "SELECT DISTINCT $week AS `week`, YEAR( `post_date` ) AS `yr`, DATE_FORMAT( `post_date`, '%Y-%m-%d' ) AS `yyyymmdd`, count( `ID` ) AS `posts` FROM `$wpdb->posts` $join $where GROUP BY $week, YEAR( `post_date` ) ORDER BY `post_date` $order $limit";
            $key = md5($query);
            $cache = wp_cache_get( 'wp_get_post_type_archives' , 'general');
            if ( !isset( $cache[ $key ] ) ) {
                $arcresults = $wpdb->get_results($query);
                $cache[ $key ] = $arcresults;
                wp_cache_set( 'wp_get_post_type_archives', $cache, 'general' );
            } else {
                $arcresults = $cache[ $key ];
            }
            $arc_w_last = '';
            $afterafter = $after;
            if ( $arcresults ) {
                    foreach ( (array) $arcresults as $arcresult ) {
                        if ( $arcresult->week != $arc_w_last ) {
                            $arc_year = $arcresult->yr;
                            $arc_w_last = $arcresult->week;
                            $arc_week = get_weekstartend($arcresult->yyyymmdd, get_option('start_of_week'));
                            $arc_week_start = date_i18n($archive_week_start_date_format, $arc_week['start']);
                            $arc_week_end = date_i18n($archive_week_end_date_format, $arc_week['end']);
                            $url  = sprintf('%1$s/%2$s%3$sm%4$s%5$s%6$sw%7$s%8$d', home_url(), '', '?', '=', $arc_year, '&amp;', '=', $arcresult->week);
                            $text = $arc_week_start . $archive_week_separator . $arc_week_end;
                            if ($show_post_count)
                                $after = '&nbsp;('.$arcresult->posts.')'.$afterafter;
                            $output .= get_archives_link($url, $text, $format, $before, $after);
                        }
                    }
            }
        } elseif ( ( 'postbypost' == $type ) || ('alpha' == $type) ) {
            $orderby = ('alpha' == $type) ? 'post_title ASC ' : 'post_date DESC ';
            $query = "SELECT * FROM $wpdb->posts $join $where ORDER BY $orderby $limit";
            $key = md5($query);
            $cache = wp_cache_get( 'wp_get_post_type_archives' , 'general');
            if ( !isset( $cache[ $key ] ) ) {
                $arcresults = $wpdb->get_results($query);
                $cache[ $key ] = $arcresults;
                wp_cache_set( 'wp_get_post_type_archives', $cache, 'general' );
            } else {
                $arcresults = $cache[ $key ];
            }
            if ( $arcresults ) {
                foreach ( (array) $arcresults as $arcresult ) {
                    if ( $arcresult->post_date != '0000-00-00 00:00:00' ) {
                        $url  = get_permalink( $arcresult );
                        if ( $arcresult->post_title )
                            $text = strip_tags( apply_filters( 'the_title', $arcresult->post_title, $arcresult->ID ) );
                        else
                            $text = $arcresult->ID;
                        $output .= get_archives_link($url, $text, $format, $before, $after);
                    }
                }
            }
        }
        if ( $echo )
            echo $output;
        else
            return $output;
    }
}






if (!function_exists('rh_isset')) {
    function rh_isset($value) {
        if (!isset($value) || empty($value)) {
            return false;
        } else {
            return true;
        }
    }

}

if (!function_exists('rh_get_featured_image_src')) {
    function rh_get_featured_image_src($post_id = '') {
        if (!empty($post_id)) {
            if (has_post_thumbnail($post_id)) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
                $img_src = $image[0];
                return $img_src;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

}//if

if (!function_exists('rh_find_all_by_post_type')) {
    function rh_find_all_by_post_type($post_type = '',$limit=5,$orderby = 'menu_order',$order='ASC') {
        if (!empty($post_type)) {
            global $post;
            $tmp_post = $post;
            $args = array( 
                'numberposts' => $limit,
                'post_type'=> $post_type,
                'orderby'=>$orderby,
                'order'=>$order, 
            );
            $myposts = get_posts( $args );           
            if(rh_isset($myposts)&&is_array($myposts)) {
                return $myposts;
            } else {
                return false;
            }
            $post = $tmp_post;
            wp_reset_query();
        } else {
            return false;
        }

    }

}//if


if(!function_exists('rh_static_map')) {
    function rh_static_map($address='',$city='',$state='',$map_height=124,$map_width=144) {
        if( !empty($address)) {
            //and format address for use in google static maps
            $addr_parts = explode(' ',$address);
            //And remove any special characters
            $addr_parts_sanitized = array();
            foreach($addr_parts as $string) {
                $addr_parts_sanitized[] = preg_replace('/,/','',$string);   
            }
            //Now build our google maps location syntax
            $location_string = implode('+',$addr_parts_sanitized);
            $location_string.="+{$city}";
            $location_string.="+{$state}";
            $src_string = "http://maps.googleapis.com/maps/api/staticmap?";
            $src_string .= "center={$location_string}";
            $src_string .= "&zoom=13&size={$map_height}x{$map_width}";
            $src_string .= "&markers=color:red|{$location_string}";
            $src_string .= "&maptype=roadmap&sensor=false"; 
            
            $large_map_link = "http://maps.google.com/maps?q=$location_string";
            ob_start();
            ?>
                
                
            <figure>
                <a target="_blank" href="<?php echo $large_map_link ?>"><img src="<?php echo $src_string  ?>"  /></a>
                <figcaption><a target="_blank" href="<?php echo $large_map_link ?>">Click for larger map</a></figcaption>
            </figure>
            <?php 
            $html = ob_get_contents();
            ob_end_clean();
            return $html; 
        } else {
            return false;   
        }
    }
}
?>
