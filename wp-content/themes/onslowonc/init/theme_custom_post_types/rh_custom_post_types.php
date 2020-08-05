<?php 
		
	// 1. Initialize
	include('RH_CPT_Init.php');
	
	
	// 2. Set Up Custom Taxonomies, if any
	//include('RH_Custom_Tax.php');
//	new RH_Custom_Tax();
	
	// 3. Initialize Custom Post Types
	//include('RH_Custom_Post_Type.php');
	//new RH_Custom_Post_Type();
	
	include('ONS_Staff_Custom_Post_Type.php');
	new ONS_Staff_Custom_Post_Type();
    
    include('ONS_Slide_Custom_Post_Type.php');
    new ONS_Slide_Custom_Post_Type();
    
    include('ONS_News_CPT.php');
    new ONS_News_CPT();
	
	
	
	
	
	
	
		
	
	
	
	
	
	
	
			
			
			
			
			
			
		
	
		
	
	
?>