<?php
if(class_exists('RH_Custom_Tax') != true)
{
include('RH_CPT_Methods.php');
class RH_Custom_Tax extends RH_CPT_Methods {
	
	
		
	function __construct()
	{
		//This class is meant to be extended. Constructors are not fired when classes are extended.
		add_action( 'init', array(&$this,'create_custom_tax'), 0 );
		
		// Add the fields to the "lc_product_size" taxonomy, using our callback function
		add_action( 'lc_product_size_edit_form_fields', array(&$this,'lc_product_size_taxonomy_custom_fields'), 10, 2 );
		
		// Save the changes made on the "lc_product_size" taxonomy, using our callback function
		add_action( 'edited_lc_product_size', array(&$this,'save_taxonomy_custom_fields'), 10, 2 );
		
	}//end constructor
	
	public function create_custom_tax() {
		//Register our custom taxonomy
		$this->rh_register_taxonomy('lc_product_size','Product Size', 'Product Sizes',NULL,NULL,'lc_product_cpt');
		$this->rh_register_taxonomy('lc_product_flavor','Product Flavor', 'Product Flavors',NULL,NULL,'lc_product_cpt');
		
			
	}
	
	
	// A callback function to add a custom field to our "presenters" taxonomy
	function lc_product_size_taxonomy_custom_fields($tag) {
	   // Check for existing taxonomy meta for the term you're editing
		$t_id = $tag->term_id; // Get the ID of the term you're editing
		$term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
	?>
	
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="lc_product_size_sort_order">Sort Order</label>
		</th>
		<td>
			<input type="text" name="term_meta[lc_product_size_sort_order]" id="term_meta[lc_product_size_sort_order]" size="25" style="width:60%;" value="<?php echo $term_meta['lc_product_size_sort_order'] ? $term_meta['lc_product_size_sort_order'] : '0'; ?>"><br />
			<span class="description">Sort order for our product sizes.</span>
		</td>
	</tr>
	
	<?php
	}
	
	// A callback function to save our extra taxonomy field(s)
	function save_taxonomy_custom_fields( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "taxonomy_term_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
				foreach ( $cat_keys as $key ){
				if ( isset( $_POST['term_meta'][$key] ) ){
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			//save the option array
			update_option( "taxonomy_term_$t_id", $term_meta );
		}
	}
	
	
	
	
	
		
	
}//end class
}// end if class exists



?>