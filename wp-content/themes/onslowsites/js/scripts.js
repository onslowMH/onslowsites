// Primary Application Script
// REQUIRED: jQuery
jQuery(document).ready(function(e) {

    //Our back to top button behavior
    jQuery(".back_to_top").affix({
        offset:{
            top:480,
            bottom:-10            
        }
    });
    jQuery(".back_to_top").on('click', function() {

        jQuery('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;

    })

    //and a method for submitting our search form when someone clicks the spyglass
    jQuery('#submitFormButton').click(function() {
        jQuery('#searchform').submit();
    });

    //And if we want to use cross-browser friendly placeholder text
    jQuery("[placeholder]").togglePlaceholder();

    /**
     * Initialize Twitter Bootstrap carousel
     */

    if (jQuery("#myCarousel").length > 0) {
        jQuery('#myCarousel').carousel({
            interval: 8000
        });
        setTimeout(jQuery('#myCarousel').fixCaptionDisplay(), 1500);
    }




    /**
     * Supplement Bootstrap by making submenus drop on hover
     */
    jQuery('ul.nav li.dropdown').hover(
            function() {
                jQuery(".dropdown-menu", this).fadeIn();
            },
            function() {
                jQuery(".dropdown-menu", this).fadeOut('fast');
            }

    );//hover

    //And initialize our mobile jump menu
    jQuery(".jumpmenu").redhammerJumpMenu();


});//end doc ready		




/*
 * Our carousel-caption struggles to place itself properly with the masking effect. Use some javascript here to resolve.
 * Usage:
 * jQuery(document).ready(function(e) {
 *	jQuery('.carousel-caption').fixCaptionDisplay();
 * });
 */
(function(window, document, $, undefined) {
    var $this = undefined;//our master container jquery object used throughout
    var carouselHeight;
    //Get the height of our active caption area
    var currentCaption;
    var currentCaptionHeight;
    var targetTop;
    var intervalID;
    var methods = {
        init: function() {
            //Now our plugin code wrapped in return for chainability
            return this.each(function() {
                //All your plugin code goes here
                //initialize our calling element;
                $this = $(this);
                methods.bind_events();
                // Loop until things settle down
                currentCaption = $(".item.active .carousel-caption");
                currentCaption.hide();
                intervalID = window.setInterval(methods.init_caption, 500);

            });//return for chainability

        }, //end init
        init_caption: function() {
            var heightChanged = $("#myCarousel").height() != carouselHeight ? true : false;
            if (heightChanged) {
                methods.position_caption();

            } else {
                currentCaption.fadeIn();
                clearInterval(intervalID);
            }
        },
        position_caption: function() {
            //Get the height of our carousel window
            carouselHeight = $("#myCarousel").height();
            //Get the height of our active caption area
            currentCaption = $(".item.active .carousel-caption");
            currentCaptionHeight = currentCaption.outerHeight();
            targetTop = carouselHeight - currentCaptionHeight;
            currentCaption.css('top', targetTop + 'px');
            //Now make sure padding-right is sufficient to accomodate .carousel-indicators
            methods.clearIndicators();
        },
        clearIndicators: function() {
          //Get width of indicators
          var indicators = $this.find(".carousel-indicators");
          var indicatorWidth = indicators.outerWidth();
          currentCaption.css('padding-right',(indicatorWidth+40)+'px');
          
        },
        bind_events: function() {
            $(window).on('resize', function() {
                methods.position_caption();
            });
            $('#myCarousel').on('slide.bs.carousel', function() {
                $(".carousel-caption").hide();

            });
            $('#myCarousel').on('slid.bs.carousel', function() {
                methods.position_caption();
                $(".carousel-caption").fadeIn();

            });

        }, //end bind_events


    };//end methods

    $.fn.fixCaptionDisplay = function(method) {

        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.fixCaptionDisplay');
        }

    };

})(window, document, jQuery);	