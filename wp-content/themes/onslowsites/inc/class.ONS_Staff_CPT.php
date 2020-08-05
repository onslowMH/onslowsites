<?php
if(class_exists('ONS_Staff_CPT') != true)
{ 
/**
 * Custom Post Type for our Homepage Carousel Slides.
 * REQUIRED: Red Hammer Core Framework
 */
class ONS_Staff_CPT extends RH_Post_Type  {
	// Container for associated custom fieldnames
	protected static $custom_fields = array();
	
	//Define variables for our post type admin area
	public static $codename='ons_staff_cpt';
	public static $singular_name='Staff';
	public static $plural_name='Staff';
	public static $url_slug='staff';
	/**
	* set up any custom arguments for our custom post type
	*/
	public $register_post_type_args = array(
		'supports' => array('title','author', 'thumbnail','revisions','page-attributes'),
		'capability_type' => 'post',
		'taxonomies'=>array()
	 );
	 
	/**
	 * Override to add associated custom fields to this post type
	 */
	public function init_custom_fields() {
		static::$custom_fields = ONS_Staff_Meta_Box::$my_meta_box['box_fields'];
	}
	/**
         * addMetaBox Override to initialize associated custom fields
         * @return void
         */
        public function addMetaBox() {
            new ONS_Staff_Meta_Box();
        }
		
	/**
	* The following methods define the look of our edit all admin area
	*/	 
	public function my_post_type_edit_columns($columns){
		 $columns = array(
			"cb" 			=> "<input type=\"checkbox\" />",
			"title"	 		=> 'Name',
                        "menu_order"            => 'Order'
			
			 );
	 
	  return $columns;
	}
	
	public function my_post_type_custom_columns($column)
	{
		global $post;
		$values = get_post_custom( $post->ID );	
		switch ($column) {
			case "id":
				echo $post->ID;
				break;
			case "menu_order":
				echo $post->menu_order;
				break;
			
			default:
				break;
					
		}
	}//end my_post_type_custom_columns	
	
	
		
	
}//end class

}//end if class exists

?>