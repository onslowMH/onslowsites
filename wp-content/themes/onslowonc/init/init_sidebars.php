<?php // Declare sidebar widget zone	
	function rh_register_sidebars()
	{
		if (function_exists('register_sidebar')) {
//			/* Register the default sidebar */
			register_sidebar(array(
				'id'   => 'default',
				'name' =>__('Default Sidebar Widgets'),				
				'description'   => 'These are default sidebar widgets.',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
			));
			register_sidebar(array(
				'id'   => 'homepage_rail',
				'name' =>__('Homepage Rail Widgets'),				
				'description'   => 'These are widgets for Homepage rail.',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
			));
			register_sidebar(array(
				'id'   => 'homepage_secondary_rail',
				'name' =>__('Homepage Secondary Rail Widgets'),				
				'description'   => 'These are widgets for secondary Homepage rail area.',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
			));
            register_sidebar(array(
                'id'   => 'news_rail',
                'name' =>__('News Sidebar Widgets'),             
                'description'   => 'These are news landing page sidebar widgets.',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>'
            ));
			
		}//end if
	}//end function
	
	add_action('widgets_init','rh_register_sidebars');
	
	
?>