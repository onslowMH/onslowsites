<?php
if(class_exists('RH_Custom_Field_Methods') != true)
{
class RH_Custom_Field_Methods {
	
	
		
	function __construct()
	{
		//This class is meant to be extended. Constructors are not fired when classes are extended.
		
		
	}//end constructor
	
	
	
	/******************************************************************************************
	*
	* Common Custom Post Type Methods
	*
	*******************************************************************************************/
	
	//Adds a custom class to our meta boxes. We call this method when we add meta boxes.
	public function add_meta_box_classes($classes) {
		array_push($classes,'rh_meta_box');
		return $classes;	
	}
	
	//Because WP likes to store arrays with empty strings we need a method to travers and empty them
	public function traverseAndCleanseArray($array)
	{
		if(is_array($array)) {	
			foreach($array as $key=>$value)
			{
				if(is_array($value))
				{
					$value = $this->traverseAndCleanseArray($value);
					unset($array[$key]);
					$array[$key] = $value;
				} else {
					$new = $value;
					if(!isset($new)||empty($new))
					{
						unset($array[$key]);
					} else {
						$array[$key] = $new;
					}
						
				}
			}
			if( empty($array) )
			{ 
				return '';				
			} else {
				return $array;	
			}			
			
		} else {
			return $array;	
		}
	}
		
	
	
	public function rh_do_update($field_name,$pid)
	{		
		if( isset($field_name)&&!empty($field_name)&&isset($pid)&&!empty($pid) ) {
			$old = get_post_meta($pid, $field_name, true);
			$new = isset($_POST[$field_name]) &&!empty($_POST[$field_name]) ? $_POST[$field_name] : '';
			
							
			if ($new && $new != $old) {
				update_post_meta($pid, $field_name, $new);
			} elseif ( '' == $new && $old ) {
				delete_post_meta($pid, $field_name, $old);
			}
			
			
		}	
	}//end method
	
	
	
	
		
	
	


	
	
	
	
	
	
	
	
		
	
}//end class
}// end if class exists



?>