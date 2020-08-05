<?php
if(class_exists('ONS_Slide_Meta_Box') != true)
{ 
include('RH_Custom_Field_Methods.php');
include('RH_Add_More_Fields.php');
include('RH_Basic_Fields.php');
class ONS_Slide_Meta_Box extends RH_Custom_Field_Methods  {
	
	/***************
	* CONSTANTS
	*/
	//const SOMECONSTANT = "some constant";
	
	/***************
	* PROPERTIES
	*/
	//And to identify our custom meta boxes
	public $my_meta_box = array(
		'box_post_type'=>'ons_slide_cpt', 
		'box_id_attribute'=>'ons_slide_details_meta_box',
		'box_title'=>'Slide Details',
		'box_callback_function'=>'first_meta_box_cb',
		'box_fields'=>array(
			'rh_slide_url',
			
		),
	);
	
				
		
	function __construct()
	{
					
		/**
		* add our custom meta boxes
		*/ 
		add_action('add_meta_boxes', array(&$this, 'add_my_meta_boxes') );
		
		/**
		* and we now our save action where we save our unique custom post values
		*/		
		add_action('save_post', array(&$this, 'save_custom_meta_fields'), 10, 2);
		
				
		
	}//end constructor
	
	/***************
	* METHODS
	*/
	
	/************************
	* The following methods initialize our custom meta boxes
	*/	
	
	public function add_my_meta_boxes()
	{
		$box_info = $this->my_meta_box;		
		//add custom meta box
		$id = $box_info['box_id_attribute'];
		$title = $box_info['box_title'];
		$page= $box_info['box_post_type'];
		$context='normal';
		$priority='high';
		$callback_function = $box_info['box_callback_function'];
		
		//NOTE: Our callback method is within our post types controller plugin common methods
		add_meta_box($id,$title,array(&$this,"$callback_function"),$page,$context,$priority);
		//And give our metaboxes a classname for ease of styling
		add_filter('postbox_classes_' . $page . '_' . $id,array(&$this,'add_meta_box_classes') );  		
		
	}
	
	
	
	public function first_meta_box_cb()
	{
		// $post is already set, and contains an object: the WordPress post
		global $post;
		$basic_fields = new RH_Basic_Fields();
		$add_more_fields = new RH_Add_More_Fields();		
		//Now get the values		
		$values = get_post_custom( $post->ID );
		
		foreach($this->my_meta_box['box_fields'] as $val):
			$$val = isset( $values[$val] ) ? array_shift($values[$val]) : '';
		endforeach;		
				
		//We'll use this nonce field later when saving		
		wp_nonce_field ('my_doc_meta_box_nonce_id','my_doc_meta_box_nonce_fieldname');
		?>
		
		<?php 
		?>
        	<!--rh_slide_url-->
			<?php
			$fieldname = 'rh_slide_url';
			$fieldlabel = 'Slide URL (optional):';
			$fieldplaceholder = '';
			$fieldvalue = $$fieldname;
			$fieldnotes = 'Use complete url. Ex: http://www.someplace.com';
			$basic_fields->get_text_input( $fieldname, $fieldlabel , $fieldvalue, $fieldnotes, $fieldplaceholder ); 
			?>
			<!-- <hr class="rh_separator" /> -->
						
			
						
		<?php	
			
			
			
	}//end first_meta_box_cb
	
	//And for saving the common custom meta
	public function save_custom_meta_fields($pid, $post) {
		global $wpdb;
		
		// verify nonce
		if(!isset($_POST['my_doc_meta_box_nonce_fieldname']))
		{
			return $pid;
		}
		
		if ( !wp_verify_nonce($_POST['my_doc_meta_box_nonce_fieldname'], 'my_doc_meta_box_nonce_id' ) ) {
			return $pid;
		}
		
				
		// don't do on autosave or when new posts are first created
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || $post->post_status == 'auto-draft' ) return $pid;
		
		// abort if not my custom type
		if ( $post->post_type != $this->my_meta_box['box_post_type'] ) return $pid;
		
		// check permissions
		if (!current_user_can('edit_page', $pid)) {
				return $pid;
			}
		if (!current_user_can('edit_post', $pid)) {
				return $pid;
			}
			
				
		
		// save post_meta with contents of custom field
		foreach( $this->my_meta_box['box_fields'] as $fieldname ):
			$this->rh_do_update( $fieldname,$pid );	
		endforeach;
		
		
		
		
						
		
			
	}//end save_common_meta_fields
	
	
		
	
}//end class
}//end if class exists


?>