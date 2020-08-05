<?php
if(class_exists('RH_Multi_Select_Transfer_Fields') != true)
{
include('RH_Custom_Field_Methods.php');
class RH_Multi_Select_Transfer_Fields extends RH_Custom_Field_Methods {
	
	
		
	function __construct()
	{
			
		
	}//end constructor
	
	
	
	
	
	/******************************************************************************************
	*
	* Multi-Select Transfer Box Fields
	*
	*******************************************************************************************/
	
	public function get_option_transfer($fieldname='', $fieldlabel='', $fieldvalue='', $fieldnotes='', $fieldplaceholder='', $post_types_to_select=array() )
	{
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
				<!--Option Transfer-->
				<script type="text/javascript">
					jQuery(document).ready(function() {
						//First let's grab the select box we want to convert
						var multi_select = jQuery("select#<?php echo $fieldname; ?>");												
						jQuery(multi_select).multiselect2side({
								minSize:15
						});	
					}); // end doc ready	 
				 </script>
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
						<select style="height:auto;" multiple="multiple" size="5" style="width:300px;" id="<?php echo $fieldname; ?>" name="<?php echo $fieldname; ?>[]">
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
			
			
	}//end ml_add_common_meta_box_cb
	
	
	
	
	
	
	
	
	
	
	
	
		
	
}//end class
}// end if class exists



?>