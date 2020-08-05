<?php
global $wp_query;

$big = 999999999; // need an unlikely integer
$paginate_args = array(
    'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) )),
    'show_all'     => true,
    'end_size'     => 1,
    'mid_size'     => 2,
    'prev_next'    => false,
    'prev_text'    => __('« Previous'),
    'next_text'    => __('Next »'),
    'type'         => 'array',
    'add_args'     => False,
    'add_fragment' => '',
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages
);
$links_array = paginate_links( $paginate_args );
if (isset($links_array)&& !empty($links_array)) {
    $pag_links = implode(" | ", $links_array);
    echo '<div class="paginate_links_wrap">'.$pag_links.'</div>';
}
?>