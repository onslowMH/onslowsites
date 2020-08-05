/**
* README file for onslow sites core theme
* v1.1.0
*/

/***************
* Logos
***************/

// Masthead
This logo is controlled within Theme Options: Theme Logo 1. The theme expects the height of this logo to be minimum 76px. The logo width is variable.

// Footer
The logo for the site specialty is controlled within Theme Options: Theme Logo 2. The theme expects a size of 121px wide by 80px high.
The affiliation logo is controlled within Theme Options: Theme Logo 3. The theme expects a size of 284px wide by 34px high



/***************
* Social Icons
***************/

See the 'Onslow Social Media' custom post type in wordpress backend. The order of display is controlled by the 'Order' attribute.
The size of the icons are controlled by css for display. The theme expects the icon sizes to be square and at least 40px x 40px.


/***************
* Header Image
***************/
Theme expects image to be at least 1500px wide and have a minimum height of 160px. Image is fixed to top-right side of masthead for large screens. It will shift to
top-left position for small screens. Go to Appearance>Header to modify image.
Note: This is the WordPress built-in header image admin area. We only use the uploaded image in our theme. None of the other settings
in this admin area have any affect.

/***************
* Sidebar Image Widget
***************/
- Prepare image before uploading to precisely 210px wide by 80px high.
- Be sure to remove the image dimensions within the widget to allow the image to scale properly at various screen sizes.
- You can add a styled read more link by placing the following at the end of the excerpt: <a href="#" class="read_more">Learn More &raquo;</a>

/***************
* Homepage Carousel
***************/
- Slides are controlled with our 'Carousel Slides' custom post type.
- The order of slides is controlled by Attributes > Order setting from within a given slide post type.
- Slides are revealed in 'Descending' order ie. An order of 10 will be placed before an item with order of 5
- Slides must be 1000px wide by 563px high

/***************
* WordPress Media Settings
***************/
-Large image size = Homepage Carousel image size =  1000x563
-Medium size = Featured Image image size = 640x360
- Thumbnail size = Sidebar image size = 210x80

/***************
* Staff Section / Content Area Images
***************/
- The staff images displayed come from the WordPress built-in 'Featured Image' source. Simple upload a portrait oriented 4x3 ratio image.
- Code assumes portrait orientation images at 4/3 ratio for sitewide personnel images or images within content area.