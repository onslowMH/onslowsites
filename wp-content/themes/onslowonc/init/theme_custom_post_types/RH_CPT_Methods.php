<?php
if(class_exists('RH_CPT_Methods') != true)
{
class RH_CPT_Methods {
	
	
		
	function __construct()
	{
		//This class is meant to be extended. Constructors are not fired when classes are extended.
		
		
	}//end constructor
	
	
	
	/******************************************************************************************
	*
	* Common Custom Post Type Methods
	*
	******************************************************************************************/
	

################################################################################################	
	
	
 	/************************
	* The following methods register and initialize our custom post type
	*/
	
	
		
	/*************************************************************************
	ml_register_post_type('ml_article', 'Article', 'Articles', 'article');

	There is a lot more that can be passed to activate the “Article” post type but the helper is 
	programmed to use my preferred defaults without explicitly defining them in the helper.

	The parameters are Code Name (how we reference this post type in the code), Singular Label, Plural Label, 
	and Slug (for use in URL’s).
	If that’s helpful to you please feel free to dig up the /inc/helpers.php file in the theme for more information.
	
	//To simplify calls by reference require by WordPress, we reference our CPT
	// propertes for the method arguments. These are defined within the Custom Post Type plugin
	public $codename		= 'ml_article';
	public $singular_name 	= 'Article';
	public $plural_name		= 'Articles';
	public $url_slug		= 'article';	
	//And arguments for registration of our custom post type	
	public $register_post_type_args = array(); 
	
	
	**********************/
	
	
	public function rh_register_taxonomy($codename, $singular, $plural, $url_slug, $args = array(), $object_type=NULL) {
		
		// define a useful url_slug since rewriting is encouraged
		$url_slug = ($url_slug) ? $url_slug : $codename;
		
		// Add new taxonomy, make it hierarchical (like categories)
		$defaults = array(
			'hierarchical' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => $url_slug ),
		);
		
		$args = wp_parse_args($args, $defaults);
				
		$labels = array(
			'name' => _x( $plural, 'taxonomy general name' ),
			'singular_name' => _x( $singular, 'taxonomy singular name' ),
			'search_items' =>  __( 'Search ' . $plural ),
			'all_items' => __( 'All ' . $plural ),
			'parent_item' => __( 'Parent ' . $singular ),
			'parent_item_colon' => __( 'Parent ' . $singular . ':' ),
			'edit_item' => __( 'Edit ' . $singular ), 
			'update_item' => __( 'Update ' . $singular ),
			'add_new_item' => __( 'Add New ' . $singular ),
			'new_item_name' => __( 'New ' . $singular . ' Name' ),
			'menu_name' => __( $singular ),
		);
		
		$args = array(
			'labels' => $labels,
			'hierarchical' => $args['hierarchical'],
			'show_ui' => $args['show_ui'],
			'query_var' => $args['query_var'],
			'rewrite' => $args['rewrite'],
			
		); 	
		
		register_taxonomy( $codename, $object_type , $args );	
	}
	
	
	public function rh_register_post_type($codename, $singular, $plural, $url_slug, $args = array())
	{
		// define a useful url_slug since rewriting is encouraged
		$url_slug = ($url_slug) ? $url_slug : $codename;
		
		// BEGIN TAXONOMIES :: Assign a set of taxonomies to the post stype
		if(!isset($args['taxonomies']))
		{
			// look for public non-builtin taxonomies (this includes custom taxonomies)
			$custom_taxonomy_args=array(
				'public'   => true,
				'_builtin' => false,
			);
			$taxonomies = get_taxonomies($custom_taxonomy_args, 'names', 'and');
			
			// merge the builtin and non-builtin taxonomies
			$taxonomies = array_merge(array('post_tag'), array_keys($taxonomies));
		}
		else
		{
			$taxonomies = array('category', 'post_tag');
		}
		// END TAXONOMIES
		
		$defaults = array(
			'capability_type' => 'post',
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'comments', 'revisions'),
			'taxonomies' => $taxonomies,
			'heirarchical' => false,
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'menu_position' => null,
			'menu_icon' => null,
			'rewrite' => array('slug' => $url_slug),
			'has_archive' => true,
		);
		
		$args = wp_parse_args($args, $defaults);
		
		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'add_new_item' => 'Add New ' . $singular,
			'edit_item' => 'Edit ' . $singular,
			'new_item' => 'Create ' . $singular,
			'view_item' => 'View ' . $singular,
			'search_items' => 'Search ' . $singular,
			'not_found' =>  'No ' . strtolower($plural) . ' found',
			'not_found_in_trash' => 'No ' . strtolower($plural) . ' found in trash',
		);
	 
		$args = array(
			'labels' => $labels,
			'public' => $args['public'],
			'publicly_queryable' => $args['publicly_queryable'],
			'exclude_from_search' => $args['exclude_from_search'],
			'show_ui' => $args['show_ui'],
			'show_in_menu' => $args['show_in_menu'],
			'menu_position' => $args['menu_position'],
			'menu_icon' => $args['menu_icon'],
			'rewrite' => $args['rewrite'],
			'capability_type' => $args['capability_type'],
			'hierarchical' => $args['heirarchical'],
			'supports' => $args['supports'],
			'taxonomies' => $args['taxonomies'],
			'has_archive' => $args['has_archive'],
		); 
	
		register_post_type($codename, $args);
	}	
	
	
	
	
	
	
	
	
		
	
}//end class
}// end if class exists



?>