<?php
if(class_exists('RH_Custom_Fields_Init') != true)
{ 
/*********************
* This class initializes WordPress behaviors for our plugin
*/
class RH_Custom_Fields_Init  {
	
	/***************
	* PROPERTIES
	*/
	//Our plugin folder name
	protected $pluginFolder='theme_custom_fields';
	protected $pluginPath;  
    protected $pluginUrl;
	private $error_msg = false;//Not in use now...but can be used for form validation if necessary
			
	function __construct()
	{	
		// Set Plugin Path  
        $this->pluginPath = dirname(__FILE__); //Our includes path that refers to this plugin folder  
        // Set Plugin URL  
        $this->pluginUrl = get_template_directory_uri() . '/init/' . $this->pluginFolder;//Our url for use in style sheet calls, etc.
			
				
		/**
		* supporting backend scripts
		*/
		add_action('admin_print_scripts', array(&$this, 'my_admin_scripts') );
		
		/**
		* plugin styles
		*/
		add_action('admin_head', array(&$this, 'my_admin_styles') );
		
		/**
		* In support of our Browse button behaviors: So that our Insert Into Post button
		*	 is always present whether or not editor is supported in a given post type
		*/
		
		add_filter('get_media_item_args', array(&$this,'allow_img_insertion') );
						
		
		
	}//end constructor
	
	/***************
	* METHODS
	*/
	
		
	public function allow_img_insertion($vars) {
		$vars['send'] = true;// 'send' as in "Send to Editor"
		return $vars;	
	}
	
	
	/*****************************************************************
	* The following methods support our plugin admin area behaviors and styles
	*/
	public function my_admin_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery-ui-sortable');
		wp_register_script('rh_default_file_upload', $this->pluginUrl . '/js/rh_media_upload.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('rh_default_file_upload');
		//And our add more functionality
		wp_register_script('rh_default_add_more',$this->pluginUrl . '/js/rh_add_more.js',array('jquery','media-upload','thickbox'));
		wp_enqueue_script('rh_default_add_more');
		//And our drag and drop sortable functionality
		wp_register_script('rh_init_sortable',$this->pluginUrl . '/js/init_sortable.js',array('jquery','media-upload','thickbox', 'jquery-ui-sortable' ));
		wp_enqueue_script('rh_init_sortable');
		
	}
	
	public function my_admin_styles() {
		//And our admin styles
		$stylesheet_href=$this->pluginUrl . '/css/admin_styles.css';
		ob_start();
		?>		
		<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet_href ?>" />
		<?php 
		$html = ob_get_contents();
		ob_end_clean();
		echo $html; 
		
		
		
		
	}
	
	
	
	
	
	
	
		
	
}//end class

}//end if class exists

?>