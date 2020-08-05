<?php
if(class_exists('RH_Custom_Post_Type') != true)
{ 
/*********************
* Our wrapper class for our post type
*/
include('RH_CPT_Methods.php');
class RH_Custom_Post_Type extends RH_CPT_Methods  {
	
	/***************
	* PROPERTIES
	*/
	//Our plugin folder name
	//protected $pluginFolder='rh_blank_plugin';
	//Define variables for our post type admin area
	public $codename		= 'rh_blank_cpt';
	public $singular_name 	= 'Blank Custom Post Type';
	public $plural_name		= 'Blank Custom Post Types';
	public $url_slug		= 'blank_posts_type';
	/**
	* set up any custom arguments for our custom post type
	*/
	public $register_post_type_args = array(
		'supports' => array('title','author', 'thumbnail','revisions','page-attributes'),
		'capability_type' => 'page',
		'taxonomies'=>array('rh_blank_tax')
	 );
	
	
	private $error_msg = false;//Not in use now...but can be used for form validation if necessary
			
			
	function __construct()
	{	
		/****
		* If initializing in plugin...use the following init
		***********/
		//Note we set our plugins controller with a priority of 5 so those classes will be available
		//add_action('plugins_loaded', array(&$this,'init_my_post_type'), 10 );
		
		/********
		* else...if including in functions.php....use this init:
		*******/
		// Add action to register the post type, if the post type does not already exist  
		$this->init_my_post_type();  
		  	
		
	}//end constructor
	
	/***************
	* METHODS
	*/	
	
	public function init_my_post_type()
	{							
		/**
		* init our custom post type
		*/
		if( ! post_type_exists( $this->codename ) )  
		{ 
			add_action('init', array(&$this, 'register_my_post_type') );
		}
		
			
		/**
		* Now methods to define our edit menu
		*/
		add_action("manage_" . $this->codename . "_posts_custom_column", array(&$this, "my_post_type_custom_columns") );		
				
		
		add_filter("manage_edit-" . $this->codename . "_columns", array(&$this, "my_post_type_edit_columns") );		
		
	
	}//end init
	
	
	
	
	/************************
	* The following methods define the look of our edit all admin area
	*/
	 
	public function my_post_type_edit_columns($columns){
		 $columns = array(
			"cb" 			=> "<input type=\"checkbox\" />",
			"title"	 		=> 'Display Name',
			"bt_title" 			=> 'Display Title',
			"id" 			=> 'ID',
			
			
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
			case "bt_title":
				$professional_title = get_post_meta($post->ID, 'bt_title',true);
				if(isset($professional_title)&&!empty($professional_title)):
					echo $professional_title;
				else:
					echo '';
				endif;
				break;		
			default:
				break;
					
		}
	}//end my_post_type_custom_columns
	
	
	
	/****************************
	*
	* Registers our Custom Post Type
	*
	****************************/
	
	public function register_my_post_type()
	{
		//Using method from our common methods controller
		$this->rh_register_post_type($this->codename,$this->singular_name,$this->plural_name,$this->url_slug,$this->register_post_type_args);
	}
	
	
	
		
	
}//end class

}//end if class exists

?>