jQuery(document).ready(function() {
	//And for all our bowse button behavior
	jQuery('.browse_button').click(function() {
		var formfield = jQuery(this).prev("input");
		window.send_to_editor = function(html) {
			
			//Grab our href
			var href = jQuery(html).attr('href');
			//Now convert to relative path
			if(href==undefined) {
				alert('You need the WordPress Link URL field populated with the file url. If you see a blank media upload screen, close it and try again.');
				return;
			}
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
 
});
 
