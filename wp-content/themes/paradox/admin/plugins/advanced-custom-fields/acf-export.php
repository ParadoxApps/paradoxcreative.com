<?php
/**
 * Automated PHP export for Advanced Custom Fields
 *
 * Export is initiated whenever an admin publishes a new field group 
 * or saves changes to an existing field group.
 *
 * Place this code in your theme's functions.php file.
 *
 */
add_action('admin_head-post.php', 'my_acf_export');
function my_acf_export() {  
	global $acf;
	$acf_fld_grp = new acf_field_group();

	// IMPORTANT: 
	// Enter the absolute path to the file you want to export into:
	$file = get_template_directory().'/admin/options.php';

	// Enter license keys for ACF add-ons here, if you have them:
	$repeater = 'QJF7-L4IX-UCNP-RF2W';
	$options_page = 'OPN8-FA4J-Y2LW-81LS';
	$flexible_content = 'FC9O-H6VN-E4CL-LT33';
	$gallery = 'GF72-8ME6-JS15-3PZC';

	// Only continue if we're saving a field group
	if ( empty($_GET['message']) || ($_GET['message'] != '1' && $_GET['message'] != '6') ) {
		return;
	}

	$fields = array();
	$fields = get_posts(array(
		'numberposts' 	=> -1,
		'post_type' 	=> 'acf',
		'orderby' 		=> 'menu_order title',
		'order' 		=> 'asc',
	));

	if($fields)
	{
				
$output = __('<?php
	/**
	 * Activate Add-ons
	 * Here you can enter your activation codes to unlock Add-ons to use in your theme. 
	 * Since all activation codes are multi-site licenses, you are allowed to include your key in premium themes.
	 */','acf'); 
	 

	$output .= '
	function my_acf_settings( $options )
	{
	    // activate add-ons
	    $options["activation_codes"]["repeater"] = "'.$repeater.'";
	    $options["activation_codes"]["options_page"] = "'.$options_page.'";
	    $options["activation_codes"]["flexible_content"] = "'.$flexible_content.'";
	    $options["activation_codes"]["gallery"] = "'.$gallery.'";
	    
		$options["options_page"]["title"] = "Theme Options";
	    
	    // setup other options (http://www.advancedcustomfields.com/docs/filters/acf_settings/)
	    return $options;
	    
	}
	add_filter("acf_settings", "my_acf_settings");
	';


	$output .= __('
	/**
	 * Register field groups
	 * The register_field_group function accepts 1 array which holds the relevant data to register a field group
	 * You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
	 * This code must run every time the functions.php file is read
	 */'
	,'acf'); 

	$output .= '
	if(function_exists("register_field_group"))
	{';

		foreach($fields as $field)
		{
			$var = array(
				'id' => uniqid(),
				'title' => get_the_title($field->ID),
				'fields'     => $acf_fld_grp->get_fields( array(), $group->ID ),
				'location'   => $acf_fld_grp->get_location( array(), $group->ID ),
				'options'    => $acf_fld_grp->get_options( array(), $group->ID ),
				'menu_order' => $field->menu_order,
			);
			
			$html = var_export($var, true);
			
			// change double spaces to tabs
			$html = str_replace("  ", "\t", $html);
			
			// add extra tab at start of each line
			$html = str_replace("\n", "\n\t", $html);

			// remove excess space from beginning of arrays
			$html = str_replace("array (", "array(", $html);
			
			$output .= ' 
		register_field_group('.$html.'); ';

		}

	$output .= '
	}
	';
	}
	else
	{
		$output = __('No field groups were selected','acf');
	}


	if (is_writable($file)) {
		file_put_contents($file, $output);
		define('ACF_EXPORT_FILE', $file);
		add_action('admin_notices', 'my_acf_export_success');
	}  else {
		add_action('admin_notices', 'my_acf_export_fail');
	}
} 

/**
 * Notice to display when export is completed successfully
 */
function my_acf_export_success( $file = '' ) {
	if (defined('ACF_EXPORT_FILE')){
		$destination = ' to <strong>'.ACF_EXPORT_FILE.'</strong>';
	} else {
		$destination = '';
	}
	echo '<div class="updated"><p>All fields successfully exported'.$destination.'.</p></div>';
}

/**
 * Error message to display when export fails (file not writable)
 */
function my_acf_export_fail( $file = '' ) {
	echo '<div class="error"><p><strong>Automated Export Error:</strong> The export file you\'ve specified is not writeable.</p></div>';
}
