<?php 
//Requires WP Theme Customization API added in WP 3.4
if (class_exists('WP_Customize_Control')) {
	/**
	 * Build custom controls to extend the theme customization screen.
	 * 
	 * @link http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
	 */
	class RH_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	
		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
}	
	
/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 */
class MyThemeOptions 
{
    
    /**
     * Registers the settings with WordPress.
     * 
     * Used by hook: 'customize_register'
     * 
     * @see add_action('customize_register',$func)
     * @param WP_Customize_Manager $wp_customize
     */
    public static function register( $wp_customize )
    {
    	/*******************
		* Google Analytics
		*******************/
		$wp_customize->add_section( 'rh_analytics_content', array(
			'title'          => 'Google Analytics',
			'priority'       => 150,
		) );
		$wp_customize->add_setting( 'rh_analytics_code', array(
			'default'        => '',

		) );
		$wp_customize->add_control( 'rh_analytics_code', array(
			'label'   => 'Analytics code',
			'section' => 'rh_analytics_content',
			'type'   => 'textarea',
		) );

		

		/*******************
		* Social Options
		*******************/
		$wp_customize->add_section( 'rh_social_settings', array(
			'title'          => 'Social Options',
			'priority'       => 150,
		) );
		//Facebook and associated control	
		$wp_customize->add_setting( 'rh_facebook_url', array(
			'default'        => '',
		) );
		
		$wp_customize->add_control( 'rh_facebook_url', array(
			'label'   => 'Facebook Link',
			'section' => 'rh_social_settings',
			'type'   => 'text',
		) );
		//Twitter and associated control	
		$wp_customize->add_setting( 'rh_twitter_url', array(
			'default'        => '',
		) );
		
		$wp_customize->add_control( 'rh_twitter_url', array(
			'label'   => 'Twitter Link',
			'section' => 'rh_social_settings',
			'type'   => 'text',
		) );
		
		/*******************
		* Site Owner Information
		*******************/
		$wp_customize->add_section( 'rh_site_owner_info_meta_box', array(
			'title'          => 'Site Owner Display Information',
			'priority'       => 150,
		) );
		//Entity proper name e.g. XYZ Company, Inc.	
		$wp_customize->add_setting( 'rh_entity_proper_name', array(
			'default'        => '',
		) );
		
		$wp_customize->add_control( 'rh_entity_proper_name', array(
			'label'   => 'Display Name e.g. XYZ Company, Inc.',
			'section' => 'rh_site_owner_info_meta_box',
			'type'   => 'text',
		) );
		//Disclaimers	
		$wp_customize->add_setting( 'rh_disclaimers', array(
			'default'        => '',
		) );
		$wp_customize->add_control( new RH_Customize_Textarea_Control( $wp_customize, 'rh_disclaimers', array(
			'label'   => 'Disclaimer 1',
			'section' => 'rh_site_owner_info_meta_box',
			'settings'   => 'rh_disclaimers',
		) ) );
		
		
		$wp_customize->add_setting( 'rh_disclaimers_alt', array(
			'default'        => '',
		) );
		$wp_customize->add_control( new RH_Customize_Textarea_Control( $wp_customize, 'rh_disclaimers_alt', array(
			'label'   => 'Disclaimer 2',
			'section' => 'rh_site_owner_info_meta_box',
			'settings'   => 'rh_disclaimers_alt',
		) ) );
		/*******************
		* Site Contact Information
		*******************/
		$wp_customize->add_section( 'rh_site_contact_info_meta_box', array(
			'title'          => 'Site Owner Contact Information Display',
			'priority'       => 150,
		) );
		
		//Street Address	
		$wp_customize->add_setting( 'rh_street_address_1', array(
			'default'        => '',
		) );
		
		$wp_customize->add_control( 'rh_street_address_1', array(
			'label'   => 'Street Address',
			'section' => 'rh_site_contact_info_meta_box',
			'type'   => 'text',
		) );
		//Street Address 2
		$wp_customize->add_setting( 'rh_street_address_2', array(
			'default'        => '',
		) );
		
		$wp_customize->add_control( 'rh_street_address_2', array(
			'label'   => 'Street Address 2',
			'section' => 'rh_site_contact_info_meta_box',
			'type'   => 'text',
		) );
		
		//Office City, State Zip	
		$wp_customize->add_setting( 'rh_city_address', array(
			'default'        => '',
		) );
		
		$wp_customize->add_control( 'rh_city_address', array(
			'label'   => 'City, State Zip',
			'section' => 'rh_site_contact_info_meta_box',
			'type'   => 'text',
		) );
		//Office Email
		$wp_customize->add_setting( 'rh_office_email', array(
			'default'        => '',
		) );
		
		$wp_customize->add_control( 'rh_office_email', array(
			'label'   => 'Email',
			'section' => 'rh_site_contact_info_meta_box',
			'type'   => 'text',
		) );
		//Office Telephone	
		$wp_customize->add_setting( 'rh_phone_number', array(
			'default'        => '',
		) );
		
		$wp_customize->add_control( 'rh_phone_number', array(
			'label'   => 'Phone',
			'section' => 'rh_site_contact_info_meta_box',
			'type'   => 'text',
		) );
		
		
		
		
		
		
		
    }//register
    
    /**
     * This will output the custom WordPress settings to the theme's WP head.
     * 
     * Used by hook: 'wp_head'
     * 
     * @see add_action('wp_head',$func)
     */
    public static function render()
    {
		?>

	<!--Customizer CSS-->
	<style type="text/css">
	<?php 
		//self::generate_css('body', 'background-color', 'rh_background_color');
	 ?>
	</style>
	<!--/Customizer CSS-->
	<?php
		}
	
		/**
		 * This will generate a line of CSS for use in header output. If the setting
		 * ($mod_name) has no defined value, the CSS will not be output.
		 *
		 * A custom helper function used within this class to keep code clean.
		 * 
		 * @uses get_theme_mod()
		 * @param string $selector CSS selector
		 * @param string $style The name of the CSS property to modify
		 * @param string $mod_name The name of the theme_mod option to fetch
		 * @param string $prefix Optional. Anything that needs to be output before the CSS property
		 * @param string $postfix Optional. Anything that needs to be output after the CSS property
		 * @param bool $echo Optional. Whether to print directly to the page (default: true).
		 * @return string Returns a single line of CSS with selectors and a property.
		 * @since Nouveau 1.0
		 */
	public static function generate_css($selector,$style,$mod_name,$prefix='',$postfix='',$echo=true)
		{
			$return = '';
			$mod = get_theme_mod($mod_name);
			if ( ! empty( $mod ) )
			{
				$return = sprintf('%s { %s:%s; }',
					$selector,
					$style,
					$prefix.$mod.$postfix
				);
				if ( $echo )
				{
					echo $return;
				}
			}
			return $return;
		}
    
}//MyThemeOptions

/********
* Place a Theme Options link in the Appearance panel
************/
add_action ('admin_menu', 'rh_theme_options_admin');
	function rh_theme_options_admin() {
		// add the Customize link to the admin menu
		add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'customize.php' );
}


/********
* Initialize custom theme options
************/
add_action( 'customize_register'    , array( 'MyThemeOptions' , 'register' ) );
//add_action( 'wp_head' , array( 'MyThemeOptions' , 'render' ) );


/********
* Other theme options
************/
// Add RSS links to <head> section
add_theme_support( 'automatic-feed-links' );
//Add featured image support
add_theme_support( 'post-thumbnails' );
//Add Custom Logo
add_theme_support( 'custom-logo' );
?>