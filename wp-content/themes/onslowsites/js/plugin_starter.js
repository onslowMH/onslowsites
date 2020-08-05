/*
* Red Hammer 
* jQuery plugin starter script
* Usage:
* jQuery(document).ready(function(e) {
*	jQuery("#map_wrap").rh_interactive_map();
* });
*/
(function( $ ){
	var $this = undefined;//our master container jquery object used throughout
	var defaults = {
		string1 : "hello ",
        string2 : "world!"
    };
    var methods = {
        init : function( options ) { 
		  	// Extend our with any options that were provided
			if ( options ) {
			  $.extend( defaults, options );
			}		
						
			//Now our plugin code wrapped in return for chainability
			return this.each(function(){
				//All your plugin code goes here
				//initialize our calling element;
				$this = $(this);
				methods.bind_events();
				
									
				
			});//return for chainability
			
		},//end init
				
        bind_events: function() {			
			//Our hover behavior that displays location label
			$this.find($("a")).hover(
				function(e){
					//console.log('Mouse In');
					$(defaults.labelContainer).removeClass();
					$(defaults.labelContainer).addClass( $(this).attr("rel") );
				},
				function(e){
					//console.log('Mouse Out');
					$(defaults.labelContainer).removeClass();
				}
			);//end hover listener
			
						
		},//end bind_events
		
		
    };//end methods

	$.fn.rh_interactive_map = function( method ) {
	
		if ( methods[method] ) {
		  return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
		  return methods.init.apply( this, arguments );
		} else {
		  $.error( 'Method ' +  method + ' does not exist on jQuery.rh_interactive_map' );
		}    
	
	};

})( jQuery );