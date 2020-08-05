<?php
if(class_exists('RH_Add_More_Fields') != true)
{
include('RH_Custom_Field_Methods.php');
class RH_Add_More_Fields extends RH_Custom_Field_Methods {
	
	
		
	function __construct()
	{
			
		
	}//end constructor
	
	
	
	
	
	/******************************************************************************************
	*
	* Custom Fields with Add More functionality
	*
	*******************************************************************************************/
	
	
	/*****
	* get_add_more_browse
	* This field array is for uploading images with the ability to drag and drop the fields to arrange sort order
	**/
	public function get_add_more_browse($fieldname='', $fieldlabel='', $fieldvalue='', $fieldnotes='', $fieldplaceholder='') {
		global $post;
		$fieldname = $fieldname;
		$fieldlabel = $fieldlabel;
		$fieldplaceholder = $fieldplaceholder;
		$fieldvalue = maybe_unserialize($fieldvalue);
		if(isset($fieldvalue)&&!empty($fieldvalue) && is_array($fieldvalue)):
			$fieldvalue = $this->traverseAndCleanseArray($fieldvalue);
		endif;
		$fieldnotes = $fieldnotes;
						
		?>
		<div class="wrap">
		<div class="rh_sortable_outer">
		<?php if(!empty($fieldnotes)):?>
			<p><?php echo $fieldnotes; ?></p>
		<?php endif;?>	 
		
		<?php if(isset($fieldvalue)&&!empty($fieldvalue)):?>
			<?php
				$field_array=maybe_unserialize($fieldvalue);
				$counter=0;
				foreach($field_array as $key=>$val):
					if(isset($val)&&!empty($val)):
					$counter++;
				?>
					<div class="add_more_container clearfix">
					
					<label for="<?php echo $fieldname; ?>"><?php echo $fieldlabel; ?></label>
					<input type="text" name="<?php echo $fieldname; ?>[]" value="<?php echo $val; ?>">
					<!--end input-->
					<input rel="<?php echo $post->ID ?>" type="button" name="<?php echo $fieldname; ?>_btn" value="Browse For File" class="browse_button" />
					</div><!--end add_more_container--> 
					
			
				<?php endif; endforeach; ?>
		<?php else:?>			
			<div class="add_more_container">
				<label for="<?php echo $fieldname; ?>"><?php echo $fieldlabel; ?></label>
				<input type="text" name="<?php echo $fieldname; ?>[]" id="<?php echo $fieldname; ?>_1" value="<?php echo $fieldvalue; ?>"		
				> <!--end input-->
				<input rel="<?php echo $post->ID ?>" type="button" name="<?php echo $fieldname; ?>_btn" value="Browse For File" class="browse_button" />
			</div><!--end add_more_container--> 
		<?php 	 
		endif;
		?>
		</div><!--#outer-->
		<a class="add_more_container_btn clearfix" href="#<?php echo $fieldname; ?>">+ Add New</a>
		</div><!--#wrap-->
		<?php
	
	}
	
	
	
	
	
	
	
	
	
	
	
		
	
}//end class
}// end if class exists



?>