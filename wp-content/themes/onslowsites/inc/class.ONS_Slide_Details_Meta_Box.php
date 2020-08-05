<?php
if(class_exists('ONS_Slide_Details_Meta_Box') != true)
{ 

class ONS_Slide_Details_Meta_Box extends RH_Meta_Box  {
	
	//And to identify our custom meta boxes
	public static $my_meta_box = array(
		'box_post_type'=>'', 
		'box_id_attribute'=>'rh_custom_page_meta_box',
		'box_title'=>'Slide Details',
		'box_fields'=>array(
			'ons_slide_heading',
                        'ons_slide_caption',
			'ons_slide_image',
                        'ons_slide_href'
			
		),
	);
	
				
		
	function __construct()
	{
					
		parent::__construct();
		static::$my_meta_box['box_post_type'] = ONS_Slide_Custom_Post_Type::$codename;		
		
	}//end constructor
	
	/***************
	* METHODS
	*/
	
	/************************
	* The following methods initialize our custom meta boxes
	*/	
	
	
	public function meta_box_cb()
	{
		// $post is already set, and contains an object: the WordPress post
		global $post;
		$basic_fields = new RH_Custom_Field_Basic();
		$add_more_fields = new RH_Custom_Field_Add_More();		
		//Now get the values		
		$values = get_post_custom( $post->ID );
		
		foreach(static::$my_meta_box['box_fields'] as $val):
			$$val = isset( $values[$val] ) ? array_shift($values[$val]) : '';
		endforeach;		
				
		//We'll use this nonce field later when saving		
		wp_nonce_field ('my_doc_meta_box_nonce_id','my_doc_meta_box_nonce_fieldname');
		?>
		
		<?php 
		?>			
                        <!--ons_slide_heading-->
			<?php
			$fieldname = 'ons_slide_heading';
			$fieldlabel = 'Slide Heading:';
			$fieldplaceholder = '';
			$fieldvalue = $$fieldname;
			$fieldnotes = '';
			echo $basic_fields->get_text_input( $fieldname, $fieldlabel , $fieldvalue, $fieldnotes, $fieldplaceholder ); 
			?>
			<hr class="rh_separator" />
			
			<!--ons_slide_caption-->
			<?php
			$fieldname = 'ons_slide_caption';
			$fieldlabel = 'Caption:';
			$fieldplaceholder = '';
			$fieldvalue = $$fieldname;
			$fieldnotes = '';
			echo $basic_fields->get_text_area( $fieldname, $fieldlabel , $fieldvalue, $fieldnotes, $fieldplaceholder );
			?> 
			<hr class="rh_separator" />
			
			<!--ons_slide_image-->
			<?php
			$fieldname = 'ons_slide_image';
			$fieldlabel = 'Image:';
			$fieldplaceholder = '';
			$fieldvalue = $$fieldname;
			$fieldnotes = '1000px by 563px image size required.';
			echo $basic_fields->get_browse( $fieldname, $fieldlabel , $fieldvalue, $fieldnotes, $fieldplaceholder );
                        
                        ?> 
			<hr class="rh_separator" />
			
                         <!--ons_slide_href-->
			<?php
			$fieldname = 'ons_slide_href';
			$fieldlabel = 'Slide Link:';
			$fieldplaceholder = '';
			$fieldvalue = $$fieldname;
			$fieldnotes = '';
			echo $basic_fields->get_text_input( $fieldname, $fieldlabel , $fieldvalue, $fieldnotes, $fieldplaceholder ); 
			?>
			<hr class="rh_separator" />
			<?php			
			
			
			
			
	}//end first_meta_box_cb
	
	
	
	
		
	
}//end class
}//end if class exists


?>