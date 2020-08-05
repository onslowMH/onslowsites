// This is our google web font config script
// This must be called prior to calling the google font library.

WebFontConfig = {
			google: { families: [ 'Ultra' ] },
			active: function(){
					//and fade in our Ultra google font
					jQuery(".wf-active header.sub_head.home h2,.wf-active header.sub_head.home h3 ").hide();
					jQuery(".wf-active header.sub_head.home h2").fadeIn(1000,function(){
							
							jQuery(".wf-active header.sub_head.home h3").fadeIn(2000);
						});
				
				},							
		}