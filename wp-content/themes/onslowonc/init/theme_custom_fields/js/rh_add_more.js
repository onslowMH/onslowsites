/***
* This script sets up our Add More custom meta box functionality. Requires jQuery
**/
var vz_add_more_fields_counter=0;
jQuery(document).ready(function() {
		
	//Now the add new behavior	
	jQuery('.add_more_container_btn').click(function(e) {
		e.preventDefault();
		var $last = jQuery(this).parent().find(".add_more_container:last");
		var $clone = $last.clone();
		
		
		console.log($clone);
		jQuery($clone).sortable();
		jQuery($clone).find(':input[type="text"]').attr('value','');
		jQuery($clone).find(':input[type="text"]').val('');		
		

		
		//And for all our browse button behaviors
		
		$clone.find('.browse_button').click(function() {
			var formfield = jQuery(this).prev("input");
			window.send_to_editor = function(html) {
				//Grab our href
				var href = jQuery(html).attr('href');
				//Now convert to relative path
				var href_array = href.split('/');
				//We eliminate the first 3 values of our array
				var href_array_temp = new Array();
				var i=0;
				for(i=3; i<href_array.length; i++)
				{
					href_array_temp.push(href_array[i]);	
				}
				var relative_href = '/';
				relative_href += href_array_temp.join('/');
				//console.log(relative_href);
				//return false;
				
				
				//imgurl = jQuery(html).attr('href');
				imgurl = relative_href;
				jQuery(formfield).val(imgurl);
				tb_remove(); 
			}
			post_id = jQuery(this).attr("rel");
			tb_show('', 'media-upload.php?post_id=' + post_id + '&amp;type=image&amp;TB_iframe=true');
			return false;
		});	
		
				
		
		//Insert clone before the add new link
		$clone.insertBefore(this);
		
						
		
		
	});//end click
	
	
				
 
});
