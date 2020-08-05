// Primary Application Script using dom based routing per Paul Irish
// REQUIRED: jQuery
jQuery(document).ready(function() {
    //In init our responsive video divs
    jQuery('.video').fitVids();

    // Add 'has_children' class to menus
    jQuery.each(jQuery('.menu-item').has('ul.sub-menu'), function() {
        jQuery(this).addClass('has_children');
    });

    //We want our #page_wrap height set to 100% if we don't have enough content so
    //our footer stays sticky
    //if( jQuery("#outer_page_wrap").height()>jQuery("#page_wrap").height() ) {
    //		jQuery("#page_wrap").css('height','100%');
    //	}

    //and a method for submitting our search form when someone clicks the spyglass
    jQuery('#submitFormButton').click(function() {
        jQuery('#searchform').submit();
    });

    //And a form placeholder text handler
    jQuery("[placeholder]").togglePlaceholder();

    //And initialize our homepage slider
    jQuery('.flexslider').flexslider({
        animation : "slide"
    });

    //And initialize our mobile jump menu
    jQuery(".jumpmenu").redhammerJumpMenu();

    //We are using links to divs in various pages. This prohibits us using our equal column
    //heights trick in css. So we'll set the content column height equal to the aside
    // so our column divider works
    (function($) {
        $.fn.equalColumns = function() {
            return this.each(function() {
               
                var $this = $(this);
                $section = $this.find("section");               
                //$aside = $this.find("aside");
                
                setTimeout(adjustHeights,1000);//Need time for hi-res images to load
                function adjustHeights() {
                    //We use 535px width in our responsive style sheet to move to one column
                    var currentWidth = $(window).outerWidth(true);
                    if(currentWidth>535) {
                        console.log('Two Col Layout');
                        //Then we do our equal col stuff
                        $sectionHeight = $section.outerHeight(true);
                        $contentHeight = $this.outerHeight(true);
                        //console.log($sectionHeight);
                        //console.log($contentHeight);                    
                        if ($sectionHeight < $contentHeight) {
                            $section.height($contentHeight);
                        }
                    } else {
                        //We need to remove any inline heights assigned by this method when one at one column
                        console.log('One Col Layout');
                        //Is there a height specified for the section?
                        if($section.attr('style') !==-1) {
                            $section.height('auto');
                        }
                        
                    }
                }

            });
        };
    })(jQuery);
    
    //We use a resize event to call our equal Columns methods as we DO NOT want this happening when we move to one column layout
    //on mobile as weird spacing results
     //We don't need this functionality at mobile sizes
    $(window).bind('resize',function(){
            jQuery("#content_wrap").equalColumns();
    });
    
    
    //$(window).bind('resize',function(){console.log('Howdy')});

    //We need separate mobile headers on the homepage in our aside area.
    (function(window, document, $, undefined) {
        var $this = undefined;
        //our master container jquery object used throughout
        var defaults = {
            string1 : "hello ",
            string2 : "world!"
        };
        var methods = {
            init : function(options) {
                // Extend our with any options that were provided
                if (options) {
                    $.extend(defaults, options);
                }

                //Now our plugin code wrapped in return for chainability
                return this.each(function() {
                    //All your plugin code goes here
                    //initialize our calling element;
                    $this = $(this);
                    methods.generate_content();
                    //methods.bind_events();

                });
                //return for chainability

            }, //end init
            
            generate_content: function() {
               //Grab our read_more link
               $readMore = $this.find("a.read_more");
               $link = $readMore.attr('href');
               //Now find our sub heading
               $subHead = $this.find('h4');
               $subHeadContent = $subHead.html();
               //Now we want to build a link in the following format
               // <h4 class="device-only"><a href="$link">Lorem ipsum dolor sit amet, consectetur adipiscing.</a></h4>
               $mobileHead = '<h4 class="device_only"><a href="'+$link+'">'+$subHeadContent+'&nbsp;&raquo;</a></h4>';
               $subHead.after($mobileHead);
            },

            
        };
        //end methods

        $.fn.rh_generate_mobile_headers = function(method) {

            if (methods[method]) {
                return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
            } else if ( typeof method === 'object' || !method) {
                return methods.init.apply(this, arguments);
            } else {
                $.error('Method ' + method + ' does not exist on jQuery.rh_interactive_map');
            }

        };

    })(window, document, jQuery);
    //Killed the call to this method...I was duplicating headers...moved functionality to php in loop-homepage_news.php
    //jQuery("#home_content_wrap aside .widget").rh_generate_mobile_headers();
    

});
// end doc ready

