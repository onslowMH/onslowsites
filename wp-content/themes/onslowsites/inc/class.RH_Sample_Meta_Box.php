<?php
if(class_exists('RH_Sample_Meta_Box') != true)
{ 

class RH_Sample_Meta_Box extends RH_Meta_Box  {
	
	//And to identify our custom meta boxes
	public static $my_meta_box = array(
		'box_post_type'=>'page', 
		'box_id_attribute'=>'rh_custom_page_meta_box',
		'box_title'=>'Custom Page Content',
		'box_fields'=>array(
			'rh_display_title',
			'rh_display_dek',
			'rh_subhead_img',
			'rh_title_color',
		),
	);
	
				
		
	function __construct()
	{
					
		parent::__construct();
				
		
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
			<!--rh_display_title-->
			<?php
			$fieldname = 'rh_display_title';
			$fieldlabel = 'Page Display Title:';
			$fieldplaceholder = '';
			$fieldvalue = $$fieldname;
			$fieldnotes = 'When populated, will override page title in front-end.';
			echo $basic_fields->get_text_input( $fieldname, $fieldlabel , $fieldvalue, $fieldnotes, $fieldplaceholder ); 
			?>
			<hr class="rh_separator" />
			<!--rh_title_color-->
			<?php
			$fieldname = 'rh_title_color';
			$fieldlabel = 'Gray display title?';
			$fieldplaceholder = '';
			$fieldvalue = $$fieldname;
			$fieldnotes = 'Check for Gray. Otherwise white is default..';
			echo $basic_fields->get_checkbox( $fieldname, $fieldlabel , $fieldvalue, $fieldnotes, $fieldplaceholder );
			?> 
			<hr class="rh_separator" />
			<!--rh_display_dek-->
			<?php
			$fieldname = 'rh_display_dek';
			$fieldlabel = 'Page Dek:';
			$fieldplaceholder = '';
			$fieldvalue = $$fieldname;
			$fieldnotes = 'Subheading for our header areas.';
			echo $basic_fields->get_text_area( $fieldname, $fieldlabel , $fieldvalue, $fieldnotes, $fieldplaceholder );
			?> 
			<hr class="rh_separator" />
			<!--rh_subhead_img-->
			<?php
			$fieldname = 'rh_subhead_img';
			$fieldlabel = 'Page Header Image:';
			$fieldplaceholder = '';
			$fieldvalue = $$fieldname;
			$fieldnotes = '1000px wide by 230px high image recommended.';
			echo $basic_fields->get_browse( $fieldname, $fieldlabel , $fieldvalue, $fieldnotes, $fieldplaceholder );
						
			
			
			
			
	}//end first_meta_box_cb
	
	
	
	
		
	
}//end class
}//end if class exists


?>