<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		
		// Google Fonts 
		$fontsSeraliazed = curl_get_file_contents('http://phat-reaction.com/googlefonts.php?format=php');
		$fontArray = unserialize($fontsSeraliazed);
		
		$fontNames = array();
		$fontNames['None'] = "Select a font";
		foreach($fontArray as $row => $innerArray){
			$fontNames[$innerArray['font-name']] = str_replace("+", " ", $innerArray['font-name']);
		}     
		
		//Social Icons ordering
		$of_options_ordering = array
		( 
			"hidden" => array (
				"placebo" 				=> "placebo", //REQUIRED!
				"facebook-block"		=> "Facebook",
				"twitter-block"			=> "Twitter",
				"linkedin-block"		=> "Linkedin",
				"google-plus-block"		=> "Google Plus",
				"instagram-block"		=> "Instagram",
				"flickr-block"			=> "Flickr"
			), 
			"visible" => array (
				"placebo" 		=> "placebo" //REQUIRED!
			),
		);
		
		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "General Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-settings.png"
				);
				
$of_options[] = array( 	"name" 		=> "Favicon",
						"desc" 		=> "Upload your favicon.",
						"id" 		=> "favicon",
						"std" 		=> "",
						"type" 		=> "upload"
				);
				
$of_options[] = array( 	"name" 		=> "Text Logo",
						"desc" 		=> "Text displayed by default as a logo rather than an image.",
						"id" 		=> "text_logo",
						"std" 		=> "Cotton",
						"type" 		=> "text"
				);
			
$of_options[] = array( 	"name" 		=> "Plain Text Logo",
						"desc" 		=> "Uncheck this box to upload your own logo rather than using plain text.",
						"id" 		=> "plain_text_logo",
						"std" 		=> 1,
						"type" 		=> "checkbox"
);
				
$of_options[] = array( 	"name" 		=> "Logo",
						"desc" 		=> "Upload your main logo.",
						"id" 		=> "logo",
						"std" 		=> "",
						"type" 		=> "upload"
				);
				
$of_options[] = array( 	"name" 		=> "Logo Lettering",
						"desc" 		=> "Upload the lettering logo for the navigation.",
						"id" 		=> "logo_lettering",
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Search & Category Results",
						"desc" 		=> "Define the number of search and category results you want to display per page. Type -1 if you want to display all posts. You should only type valid numbers.",
						"id" 		=> "number_results",
						"std" 		=> "3",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Tracking Code",
						"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into your theme.",
						"id" 		=> "google_analytics",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Styling Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-paint.png"
				);
				
$of_options[] = array( 	"name" 		=> "Main Color",
						"desc" 		=> "Pick a main color for your theme (default: #f4594e).",
						"id" 		=> "main_color",
						"std" 		=> "#f4594e",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Body Font",
						"desc" 		=> "Select a font for the body.",
						"id" 		=> "b_font",
						"std" 		=> "Cabin",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "The quick brown fox jumps over the lazy dog.", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=> $fontNames
				);
				
$of_options[] = array( 	"name" 		=> "Headings Font",
						"desc" 		=> "Select a font for the headings.",
						"id" 		=> "h_font",
						"std" 		=> "Merriweather",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "The quick brown fox jumps over the lazy dog.", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=> $fontNames
				);
				
$of_options[] = array( 	"name" 		=> "Article Font",
						"desc" 		=> "This is the font for blog posts and projects. We advice to choose a nice serifed font to achieve better readability.",
						"id" 		=> "blog_font",
						"std" 		=> "Lora",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "The quick brown fox jumps over the lazy dog.", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=> $fontNames
				);
				
$of_options[] = array( 	"name" 		=> "Custom CSS",
						"desc" 		=> "Quickly add some CSS to your theme by adding it to this block.",
						"id" 		=> "custom_css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Home Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-home.png"
				);
				
$of_options[] = array( 	"name" 		=> "Header Caption",
						"desc" 		=> "Caption to be displayed in the header.",
						"id" 		=> "caption",
						"std" 		=> "Welcome to our digital place.",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Header Sub-Caption",
						"desc" 		=> "Sub-Caption to be displayed in the header.",
						"id" 		=> "sub_caption",
						"std" 		=> "Make yourself at home.",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Background Image",
						"desc" 		=> "Upload image to be displayed in the header as background.",
						"id" 		=> "background_image",
						"std" 		=> "",
						"type" 		=> "upload"
);

$of_options[] = array( 	"name" 		=> "Footer Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-settings.png"
				);
				
$of_options[] = array( 	"name" 		=> "Ordering Social Icons",
						"desc" 		=> "Organize how you want the social icons to be displayed and which you want to display.",
						"id" 		=> "social-organize",
						"std" 		=> $of_options_ordering,
						"type" 		=> "sorter"
				);
				
$of_options[] = array( 	"name" 		=> "Facebook",
						"desc" 		=> "The link for your Facebook profile.",
						"id" 		=> "facebook",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Twitter",
						"desc" 		=> "The link for your Twitter profile.",
						"id" 		=> "twitter",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Linkedin",
						"desc" 		=> "The link for your Linkedin profile.",
						"id" 		=> "linkedin",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Google Plus",
						"desc" 		=> "The link for your Google Plus profile.",
						"id" 		=> "google-plus",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Instagram",
						"desc" 		=> "The link for your Instagram profile.",
						"id" 		=> "instagram",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Flickr",
						"desc" 		=> "The link for your Flickr profile.",
						"id" 		=> "flickr",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Copyright Text",
						"desc" 		=> "This is the copyright text that most of the websites show at the footer. You can change it here.",
						"id" 		=> "copyright_text",
						"std" 		=> "© 2013 Cotton made by digitalcookers™. All rights reserved.",
						"type" 		=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-backup.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);			
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
