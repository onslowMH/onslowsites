<?php
if(class_exists('RH_Basic_Fields') != true)
{
include('RH_Custom_Field_Methods.php');
class RH_Basic_Fields extends RH_Custom_Field_Methods {
	
	
		
	function __construct()
	{
			
		
	}//end constructor
	
	
	
	
	
	/******************************************************************************************
	*
	* Basic Input Fields
	*
	*******************************************************************************************/
	/*****
	* get_text_area
	* Basic textarea input
	**/
	public function get_text_area($fieldname='', $fieldlabel='', $fieldvalue='', $fieldnotes='', $fieldplaceholder='') {
		global $post;
		$fieldname = $fieldname;
		$fieldlabel = $fieldlabel;
		$fieldplaceholder = $fieldplaceholder;
		$fieldvalue = $fieldvalue;
		?>
			<div class="wrap">
			<?php 
				if(isset($fieldnotes)&&!empty($fieldnotes)):			
			?>
				<p class="fieldnotes"><?php echo $fieldnotes; ?></p>
			<?php 
				endif;
			?>
			<label for="<?php echo $fieldname ?>"><?php echo $fieldlabel  ?></label>
			<textarea style="width:100%;" placeholder="<?php echo $fieldplaceholder; ?>" name="<?php echo $fieldname; ?>" id="<?php echo $fieldname;?>"><?php echo htmlentities(isset($fieldvalue) && !empty($fieldvalue) ? $fieldvalue : ''); ?></textarea> <!--end input-->
			</div>
		<?php  
	
	}
	
	
	
	
	/*****
	* get_dropdown
	* Basic drop down option select input
	**/
	public function get_dropdown($fieldname='', $fieldlabel='', $fieldvalue='', $fieldnotes='', $fieldplaceholder='', $options=array()) {
		global $post;
		$fieldname = $fieldname;
		$fieldlabel = $fieldlabel;
		$fieldplaceholder = $fieldplaceholder;
		$fieldvalue = $fieldvalue;
		?>
			<div class="wrap">
			<?php 
				if(isset($fieldnotes)&&!empty($fieldnotes)):			
			?>
				<p class="fieldnotes"><?php echo $fieldnotes; ?></p>
			<?php 
				endif;
			?>
			<label for="<?php echo $fieldname ?>"><?php echo $fieldlabel  ?></label>
						
			<select style="width:20%;" name="<?php echo $fieldname ?>" id="<?php echo $fieldname ?>" title="<?php echo $fieldplaceholder; ?>">
				<?php
					$selection = isset($fieldvalue)&&!empty($fieldvalue)? $fieldvalue : $options[0]['value']; 
					foreach($options as $option_array):
					
				?>
					<option <?php echo $selection==$option_array['value']?'selected="selected"':''; ?> value="<?php echo $option_array['value'] ?>"><?php echo $option_array['label']; ?></option>
				<?php endforeach;?>
			</select>	
			
			
			</div>
		<?php
	
	}
	
	/*****
	* get_text_input
	* Basic text input
	**/
	public function get_text_input($fieldname='', $fieldlabel='', $fieldvalue='', $fieldnotes='', $fieldplaceholder='') {
		global $post;
		$fieldname = $fieldname;
		$fieldlabel = $fieldlabel;
		$fieldplaceholder = $fieldplaceholder;
		$fieldvalue = $fieldvalue;
		?>
			<div class="wrap">
			<?php 
				if(isset($fieldnotes)&&!empty($fieldnotes)):			
			?>
				<p class="fieldnotes"><?php echo $fieldnotes; ?></p>
			<?php 
				endif;
			?>
			<label for="<?php echo $fieldname ?>"><?php echo $fieldlabel  ?></label>
			<input placeholder="<?php echo $fieldplaceholder; ?>" type="text" name="<?php echo $fieldname; ?>" id="<?php echo $fieldname;?>" value="<?php echo htmlentities(isset($fieldvalue) && !empty($fieldvalue) ? $fieldvalue : ''); ?>"> <!--end input-->
			</div>
		<?php  
	
	}
	
	/*****
	* get_browse
	* Browse for image field
	**/
	public function get_browse($fieldname='', $fieldlabel='', $fieldvalue='', $fieldnotes='', $fieldplaceholder='') {
		global $post;
		$fieldname = $fieldname;
		$fieldlabel = $fieldlabel;
		$fieldplaceholder = '';
		$fieldvalue = $fieldvalue;
						
		?>
		<div class="wrap">
		<?php echo isset($fieldvalue) ? '<img src="'. esc_attr( $fieldvalue ). '" style="max-width:150px;" />' : ''; ?>
		<?php if(!empty($fieldnotes)):?>
			<p><?php echo $fieldnotes; ?></p>
		<?php endif;?>
			<label for="<?php echo $fieldname ?>"><?php echo $fieldlabel  ?></label>
			<input placeholder="<?php echo $fieldplaceholder; ?>" type="text" name="<?php echo $fieldname; ?>" id="<?php echo $fieldname;?>" value="<?php echo htmlentities(isset($fieldvalue) && !empty($fieldvalue) ? $fieldvalue : ''); ?>"> <!--end input-->
			<input rel="<?php echo $post->ID ?>" type="button" name="<?php echo $fieldname; ?>_btn" value="Browse For File" class="browse_button" />
			
		</div> 				
				
					
			
		<?php 
	}
	
	/*****
	* get_checkbox
	* Basic 0/1 checkbox
	**/
	public function get_checkbox($fieldname='', $fieldlabel='', $fieldvalue='', $fieldnotes='', $fieldplaceholder='') {
		global $post;
		$fieldname = $fieldname;
		$fieldlabel = $fieldlabel;
		$fieldplaceholder = '';
		$fieldvalue = $fieldvalue;
		?>
			<div class="wrap">
			<?php 
			if(	isset($fieldnotes)&&!empty($fieldnotes) ):
			?>
			<p class="fieldnotes"><?php echo $fieldnotes ?></p>
			<?php endif;?>
			<label><?php echo $fieldlabel  ?>&nbsp;&nbsp;<input name="<?php echo $fieldname; ?>" type="checkbox" value="1" <?php echo isset($fieldvalue)&&!empty($fieldvalue)? 'checked="checked"' : '' ?> /></label>
			
			</div>
		<?php  
	
	}
	
	
	/*****
	* get_select_box
	* This is a basic select in the box or list format
	**/
	
	public function get_select_box($fieldname='', $fieldlabel='', $fieldvalue='', $fieldnotes='', $fieldplaceholder='', $post_types_to_select=array() ) {
		global $post;
		//We're messing with the post so save it here so we can reset it at the end of this function.
		$tmp_post=$post;
		//Now our form html
		ob_start();
		?>
			<!--brx_img_header_selection-->
				<?php 
					$fieldname = $fieldname;
					$fieldlabel = $fieldlabel;
					$fieldplaceholder = $fieldplaceholder;
					$fieldvalue = $fieldvalue;
					$post_types_to_select = $post_types_to_select;
					
				?>
				
				  <?php 
				 //Grab all of our locations
				 //global $post;
				 $location_args = array( 
				 	'numberposts' => -1,
				 	'post_type'=>$post_types_to_select 
					);
				 $location_posts = get_posts($location_args);
				 $all_options = array();
				 foreach($location_posts as $post):						
					setup_postdata($post);
					$all_options[get_the_ID()] = get_the_title();
					wp_reset_postdata();
				endforeach;
				
				?>
						
				<?php 
				if( isset($fieldvalue)&&!empty($fieldvalue) ):
					$selections = maybe_unserialize($fieldvalue);
					
					//$all_options = $all_options_temp =  $personnel_posts;
					$sorted_options = array();
					foreach($selections as $val)
					{
						if(array_key_exists($val,$all_options))
						{
							$sorted_options[$val]=$all_options[$val];
							unset($all_options[$val]);	
						}
					}
					foreach($all_options as $key=>$val)
					{
						$sorted_options[$key] = $val;	
					}
				endif;	
				?>
				<?php 
					if(isset($fieldnotes)&&!empty($fieldnotes)):				
				?>
					<p><?php echo $fieldnotes; ?></p>
				<?php 
					endif;
				?>	
				<table border="0" cellpadding="10" cellspacing="0" width="100%">
				<tr>
					<td colspan="2"><label for="<?php echo $fieldname; ?>"><?php echo $fieldlabel; ?></label></td>
				</tr>
				<tr>
					<td colspan="2">
						<!--Form Input-->
						<select style="height:auto;width:100%;" size="5" id="<?php echo $fieldname; ?>" name="<?php echo $fieldname; ?>[]">
							<?php if( isset($fieldvalue)&&!empty($fieldvalue) ):?>
								<?php foreach($sorted_options as $val=>$label):?>
									<option <?php echo in_array($val,$selections) ? 'selected="selected"' : '';?> value="<?php echo $val; ?>"><?php echo $label; ?></option>
								<?php endforeach;?>
							<?php else:?>
								<?php 
								foreach($all_options as $val=>$lab):
								?>
									<option value="<?php echo $val; ?>"><?php echo $lab; ?></option>
								<?php endforeach;?>
							<?php endif;?>	
						</select>
						<!--end input-->
					</td>
				</tr>
				</table>	
			
		<?php 
		$html = ob_get_contents();
		ob_end_clean();
				
		// return the buffer contents as html string variable for WordPress shortcode to place properly
		echo $html;
		//and reset out global post....or all hell breaks loose.
		$post=$tmp_post;  
	
	}
	
	
	/*****
	* get_text_editor
	* This is the WordPress text editor call as of 3.3
	**/
	public function get_text_editor($fieldname='', $fieldlabel='', $fieldvalue='', $fieldnotes='', $fieldplaceholder='') {
		global $post;
		$fieldname = $fieldname;
		$fieldlabel = $fieldlabel;
		$fieldplaceholder = '';
		$fieldvalue = $fieldvalue;
		?>
			<div class="wrap">
			<?php 
				if(isset($fieldnotes)&&!empty($fieldnotes)):			
			?>
				<p class="fieldnotes"><?php echo $fieldnotes; ?></p>
			<?php 
				endif;
			?>
			<label for="<?php echo $fieldname ?>"><?php echo $fieldlabel  ?></label>
			<?php 
				$content = htmlentities(isset($fieldvalue) && !empty($fieldvalue) ? $fieldvalue : '');
				$editor_id = $fieldname;
				$settings = array(
						'textarea_name'=>$fieldname,
					);
				wp_editor($content,$editor_id,$settings);
			?>
			
			</div>
		<?php  
	
	}
	
	
	
	
	
	
	
	
		
	
}//end class
}// end if class exists



?>