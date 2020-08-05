<?php
if(class_exists('RH_Sample_Custom_Taxonomy') != true)
{
class RH_Sample_Custom_Taxonomy extends RH_Taxonomy {
	
	public static $codename='rh_sample_custom_tax';
	public static $singular='Sample Custom Taxonomy';
	public static $plural='Sample Custom Taxonomies';
	public static $url_slug = 'sample_custom_tax';
	public static $args = array();
	public static $associated_post_type='rh_sample_cpt';
		
	function __construct()
	{
		parent::__construct();
		
	}//end constructor
	
	
	
	
	
		
	
}//end class
}// end if class exists



?>