/****************
	This file initializes our header area slideshows
	
	REQUIRED: jQUERY, jQuery Cycle Plugin
	
*******/

jQuery(document).ready(function(){
        jQuery('#slides').cycle({
            fx: 'fade', 
          	timeout: 5000,
        	// prev: '#prev',
        	// next: '#next',
	});
});