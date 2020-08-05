<?php
if(class_exists('ONS_Social_Media_Post_Type') != true)
{ 
/**
 * Sample Custom Post Type Declaration using the Red Hammer Core Framework
 */
class ONS_Social_Media_Post_Type extends RH_Post_Type  {
	// Container for associated custom fieldnames
	protected static $custom_fields = array();
	
	//Define variables for our post type admin area
	public static $codename='ons_social_media_cpt';
	public static $singular_name='Onslow Social Media';
	public static $plural_name='Onslow Social Media';
	public static $url_slug='social-media';
	/**
	* set up any custom arguments for our custom post type
	*/
	public $register_post_type_args = array(
		'supports' => array('title','author','thumbnail','revisions','page-attributes'),
		'capability_type' => 'post',
		'taxonomies'=>array()
	 );
        
       
        /**
         * addMetaBox Override to initialize associated custom fields
         * @return void
         */
        public function addMetaBox() {
            new ONS_Social_Details_Meta_Box();
        }
	 
	/**
	 * Override to add associated custom fields to this post type
	 */
	public function init_custom_fields() {
            static::$custom_fields = ONS_Social_Details_Meta_Box::$my_meta_box['box_fields'];
	}	
		
	/**
	* The following methods define the look of our edit all admin area
	*/	 
	public function my_post_type_edit_columns($columns){
		 $columns = array(
			"cb" 			=> "<input type=\"checkbox\" />",
			"id" 			=> 'ID',
			"title"	 		=> 'Title',
			"menu_order"	 	=> 'Sort Order',
			
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