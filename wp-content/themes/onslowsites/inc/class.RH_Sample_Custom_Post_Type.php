<?php
if(class_exists('ONS_Slides_Custom_Post_Type') != true)
{ 
/**
 * Sample Custom Post Type Declaration using the Red Hammer Core Framework
 */
class RH_Sample_Custom_Post_Type extends RH_Post_Type  {
	// Container for associated custom fieldnames
	protected static $custom_fields = array();
	
	//Define variables for our post type admin area
	public static $codename='rh_sample_cpt';
	public static $singular_name='Sample Custom Post Type';
	public static $plural_name='Sample Custom Post Types';
	public static $url_slug='sample_custom_post_type';
	/**
	* set up any custom arguments for our custom post type
	*/
	public $register_post_type_args = array(
		'supports' => array('title','editor','author', 'thumbnail','revisions','page-attributes'),
		'capability_type' => 'post',
		'taxonomies'=>array()
	 );
	 
	/**
	 * Override to add associated custom fields to this post type
	 */
	public function init_custom_fields() {
		//static::$custom_fields = CB_Staff_Details_Meta_Box::$my_meta_box['box_fields'];
	}
	
		
	/**
	* The following methods define the look of our edit all admin area
	*/	 
	public function my_post_type_edit_columns($columns){
		 $columns = array(
			"cb" 			=> "<input type=\"checkbox\" />",
			"id" 			=> 'ID',
			"title"	 		=> 'Title',
			
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
			
			default:
				break;
					
		}
	}//end my_post_type_custom_columns	
	
	
		
	
}//end class

}//end if class exists

?>