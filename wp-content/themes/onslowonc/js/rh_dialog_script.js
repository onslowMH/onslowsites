// These scripts control our Tell-A-Friend modal dialog

jQuery(document).ready(function() {
	
	var rh_dialog_container = jQuery("div#rh_dialog_container");
    rh_dialog_container.dialog({                   
        'dialogClass'   : 'wp-dialog rh_dialog',           
        'modal'         : true,
        'autoOpen'      : false, 
        'closeOnEscape' : true,      
        /*'buttons'       : {
            "Close": function() {
                jQuery(this).dialog('close');
            }
        },*/
		/*open: function(event, ui) {
			jQuery('.ui-widget-overlay').bind('click',function(){
				//console.log(tell_friend_form);
                //jQuery('#dialog').dialog('close');
				tell_friend_form.dialog('close');
            })
            	
        },*/
		title: "Tell A Friend",
		//Width and height dictated by fancy background image
		width: 604,
		zIndex:9999,
		position: 'top'
    });
	
	
	
	
	
    jQuery("a.tell_a_friend").click(function(event) {
        event.preventDefault();
		//console.log('Hello');
        rh_dialog_container.dialog('open');
    });
	
	//We want to auto open our dialog after form submission
	var rh_dialog_container_submitted = jQuery("#rh_dialog_container.submitted");
    rh_dialog_container_submitted.dialog({                   
        'autoOpen'      : true, 
        
    });
	
	//And our result box close button
	 jQuery("#rh_dialog_container.submitted a.brixx_button").click(function(event) {
        event.preventDefault();
		//console.log('Hello');
        rh_dialog_container_submitted.dialog('close');
		//And in order to refresh out page so other emails can be sent we redirect back to page
		var current_url = window.location.href;
		window.location = current_url;
		
    });
	




		
}); // end doc ready

