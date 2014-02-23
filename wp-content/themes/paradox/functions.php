<?php
/*
 *  Author: Digital Cookers | @digitalcookers
 *  URL: digitalcookers.net | @digitalcookers
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	Load Options and Plugins
\*------------------------------------*/
 
require_once ('admin/index.php');
define( 'ACF_LITE' , true );
include_once( get_template_directory() . '/admin/plugins/advanced-custom-fields/acf.php' );
include_once( get_template_directory() . '/admin/options.php' );
include_once(get_template_directory() . '/admin/plugins/post-types-order/post-types-order.php'); 

// Add Home button the available menu pages
function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );

// Change the fallback menu styling
function add_menuid ($page_markup) {
preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
$divclass = $matches[1];
$toreplace = array('<div class="'.$divclass.'">', '</div>');
$new_markup = str_replace($toreplace, '', $page_markup);
$new_markup = preg_replace('/^<ul>/i', '<ul class="sidebar-nav">', $new_markup);
return $new_markup; }

add_filter('wp_page_menu', 'add_menuid');

// 100% Image quality for images
add_filter( 'jpeg_quality', 'smashing_jpeg_quality' );
function smashing_jpeg_quality() {
    return 100;
}

// Replace the default get_file_contents()
function curl_get_file_contents($URL)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $URL);
    $contents = curl_exec($c);
    curl_close($c);

    if ($contents) return $contents;
        else return FALSE;
}

// Validation for comment form
function comment_validation_init() {
	if(is_single() && comments_open() ) { ?>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
		$('#commentform').validate({
		 
			rules: {
				author: {
					required: true,
					minlength: 2
				},
			
				email: {
					required: true,
					email: true
				},
			
				comment: {
					required: true
			}
		},
		 
		messages: {
			author: "Please enter your name.",
			email: "Please enter a valid email address.",
			comment: "Message box can't be empty!"
		},
		 
		errorElement: "div",
		errorPlacement: function(error, element) {
			element.before(error);
		}
		 
		});
		});
		</script>
	<?php
	}
}
add_action('wp_footer', 'comment_validation_init');

// Rearrange the admin menu
function custom_menu_order($menu_ord) {
   if (!$menu_ord) return true;
      return array(
      'index.php', // Dashboard
      'edit.php', // Posts
      'edit.php?post_type=sections', // Custom type one
      'edit.php?post_type=portfolio', // Custom type two
      'edit.php?post_type=page', // Pages
      'separator1', // First separator
      'upload.php', // Media
      'link-manager.php', // Links
      'edit-comments.php', // Comments
      'separator2', // Second separator
      'themes.php', // Appearance
      'plugins.php', // Plugins
      'users.php', // Users
      'tools.php', // Tools
      'options-general.php', // Settings
      'separator-last', // Last separator
   );
}

add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');

// Custom Styles 
function generate_options_css() {
    $ss_dir = get_stylesheet_directory();
    ob_start(); // Capture all output into buffer
    require($ss_dir . '/inc/custom-styles.php'); // Grab the custom-style.php file
    $css = ob_get_clean(); // Store output in a variable, then flush the buffer
    file_put_contents($ss_dir . '/css/custom-styles.css', $css, LOCK_EX); // Save it as a css file
}
add_action( 'parse_request', 'generate_options_css' ); //Parse the output and write the CSS file

//Hex to RGB
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    
    add_theme_support('post-formats', array('gallery','image','video','audio') );

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('cotton', get_template_directory() . '/languages');
}

/* Allow SVG Upload */

add_filter('upload_mimes', 'custom_upload_mimes');

function custom_upload_mimes ( $existing_mimes=array() ) {

	$existing_mimes['svg'] = 'mime/type';

	return $existing_mimes;

}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// cotton Blank navigation
function cotton_header_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => '',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="list-inline">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// cotton Blank navigation
function cotton_sidebar_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'off-canvas-menu',
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="sidebar-nav">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

add_filter('template_redirect', 'page_section_redirect');
function page_section_redirect(){
	global $wp;

	if(isset($wp->query_vars["sections"])){

		wp_redirect(home_url('/#').$wp->query_vars["name"]);

	}
}

add_filter( 'wp_nav_menu_objects', 'single_page_nav_links' );
function single_page_nav_links( $items ) {

	foreach ( $items as $item ) {

		if('sections' == $item->object){

			$current_post = get_post($item->object_id);

			$menu_title = "#".$current_post->post_name;

				if(!is_home()){

					$item->url = home_url( '/' ).$menu_title;

				} else {

					$item->url = $menu_title;
				}

		} else if ('custom' == $item->type && !is_home()){

			if( 1 === preg_match('/^#([^\/]+)$/', $item->url , $matches)){
			 	
			 	$item->url = home_url( '/' ).$item->url;
			}
			
		}
	}

	return $items;   
}

// Load cotton Blank scripts (header.php)
function cotton_header_scripts()
{

    if (!is_admin()) {
    
    	wp_deregister_script('jquery');
    	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js', array(), '1.9.1');
    	wp_enqueue_script('jquery');
    	
    	wp_register_script('conditionizr', 'http://cdnjs.cloudflare.com/ajax/libs/conditionizr.js/2.2.0/conditionizr.min.js', array(), '2.2.0');
        wp_enqueue_script('conditionizr');
        
        wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.6.2'); // Modernizr
        wp_enqueue_script('modernizr');
        
        wp_register_script('jquery-easing', get_template_directory_uri() . '/js/jquery.easing.js', array(), '1.3.0'); 
        wp_enqueue_script('jquery-easing');
        
        wp_register_script('idangerous-swiper', get_template_directory_uri() . '/js/idangerous.swiper.js', array(), '2.1.0'); 
        wp_enqueue_script('idangerous-swiper');
       
        wp_register_script('jquery-mixitup', get_template_directory_uri() . '/js/jquery.mixitup.js', array(), '1.5.3'); 
        wp_enqueue_script('jquery-mixitup');

        wp_register_script('jquery-player', get_template_directory_uri() . '/js/jquery.jplayer.js', array(), '2.3.0'); 
        wp_enqueue_script('jquery-player');

        wp_register_script('flickr', get_template_directory_uri() . '/js/jquery.flickr.js', array(), '1.5.3'); 
        wp_enqueue_script('flickr');

        wp_register_script('instagram', get_template_directory_uri() . '/js/jquery.instagram.js', array(), '1.5.3'); 
        wp_enqueue_script('instagram');
        
        wp_register_script('twitter', get_template_directory_uri() . '/js/jquery.twitter.js', array(), '1.5.3'); 
        wp_enqueue_script('twitter');
        
        wp_register_script('timeago', get_template_directory_uri() . '/js/jquery.timeago.js', array(), '1.5.3'); 
        wp_enqueue_script('timeago');

        wp_register_script('fluidvids', get_template_directory_uri() . '/js/fluidvids.js', array(), '1.2.0', true); 
        wp_enqueue_script('fluidvids');

        wp_register_script('masonry', get_template_directory_uri() . '/js/masonry.js', array(), '3.1.2', true);
        wp_enqueue_script('masonry');        
        wp_register_script('images-loaded', get_template_directory_uri() . '/js/imagesloaded.js', array(), '3.0.4', true); 
        wp_enqueue_script('images-loaded'); 
        
        wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.0.0'); 
        wp_enqueue_script('bootstrap'); 
       
        wp_register_script('cottonscripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0'); 
        wp_enqueue_script('cottonscripts'); 
    }
}

// Load cotton Blank conditional scripts
function cotton_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); 
    }
}

// Load cotton Blank styles
function cotton_styles()
{
	
	wp_register_style('google-fonts', 'http://fonts.googleapis.com/css?family=Cabin:400,700,400italic|Merriweather:900|Lora:400,700,400italic', array(), '1.0', 'all');
    wp_enqueue_style('google-fonts'); 

    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); 

    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0', 'all');
    wp_enqueue_style('bootstrap'); 
    
    wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.0', 'all');
    wp_enqueue_style('font-awesome'); 
    
    wp_register_style('cotton', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('cotton'); 
    
    wp_enqueue_style( 'custom-styles', get_template_directory_uri() . '/css/custom-styles.css' );
}

// Register cotton Blank Navigation
function register_cotton_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'cotton'), // Main Navigation
        'off-canvas-menu' => __('Off-Canvas Menu', 'cotton') // Off-Canvas Navigation
      
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'cotton'),
        'description' => __('The widgets will be displayed at offcanvas menu..', 'cotton'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="collapse">'
    ));

}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function cottonwp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text'    => __('<i class="icon-angle-left icon-large"></i>'),
		'next_text'    => __('<i class="icon-angle-right icon-large"></i>')
    ));
}

// Custom Excerpts
function cottonwp_index($length) // Create 20 Word Callback for Index page Excerpts, call using cottonwp_excerpt('cottonwp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using cottonwp_excerpt('cottonwp_custom_post');
function cottonwp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function cottonwp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function cotton_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'cotton') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function cotton_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function cottongravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function cottoncomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<div class="row">
	<?php endif; ?>
	<div class="col-xs-12 col-sm-4">
	<div class="comment-author vcard">
<!-- 	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?> -->
	<?php printf(__('<cite class="fn">%s</cite> <span class="says"></span>'), get_comment_author()) ?>
	</div>
	<div class="comment-meta commentmetadata">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
	</div>
	
	<div class="comment-icons">
		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<i class="icon-mail-reply"></i>'))) ?>	
		<?php edit_comment_link(__('<i class="icon-edit icon-large"></i>'),'  ','' ); ?>
	</div>
	
	</div>
	
	<div class="col-xs-12 col-sm-8 text">
		<?php comment_text() ?>
		<?php if ($comment->comment_approved == '0') : ?>
			<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
		<?php endif; ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'cotton_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'cotton_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'cotton_styles'); // Add Theme Stylesheet
add_action('init', 'register_cotton_menu'); // Add cotton Blank Menu
add_action('init', 'create_post_types'); // Add Custom Post Types
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'cottonwp_pagination'); // Add our cotton Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'cottongravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'cotton_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'cotton_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('cotton_shortcode_demo', 'cotton_shortcode_demo'); // You can place [cotton_shortcode_demo] in Pages, Posts now.
add_shortcode('cotton_shortcode_demo_2', 'cotton_shortcode_demo_2'); // Place [cotton_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [cotton_shortcode_demo] [cotton_shortcode_demo_2] Here's the page title! [/cotton_shortcode_demo_2] [/cotton_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called cotton-Blank
function create_post_types()
{

    register_post_type('sections', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Sections', 'cotton'), // Rename these to suit
            'singular_name' => __('Section', 'cotton'),
            'add_new' => __('Add New', 'cotton'),
            'add_new_item' => __('Add New Section', 'cotton'),
            'edit' => __('Edit', 'cotton'),
            'edit_item' => __('Edit Section', 'cotton'),
            'new_item' => __('New Section', 'cotton'),
            'view' => __('View Section', 'cotton'),
            'view_item' => __('View Section', 'cotton'),
            'search_items' => __('Search Section', 'cotton'),
            'not_found' => __('No sections found', 'cotton'),
            'not_found_in_trash' => __('No sections found in Trash', 'cotton')
        ),
        'public' => true,
        'capability_type' => 'page',
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'page-template'
        ), // Go to Dashboard Custom cotton Blank post for supports
        'can_export' => true // Allows export in Tools > Export
    ));
    
    register_taxonomy_for_object_type('category', 'cotton'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'cotton');
    
    register_post_type('portfolio', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Portfolio', 'cotton'), // Rename these to suit
            'singular_name' => __('Project', 'cotton'),
            'add_new' => __('Add New', 'cotton'),
            'add_new_item' => __('Add New Project', 'cotton'),
            'edit' => __('Edit', 'cotton'),
            'edit_item' => __('Edit Project', 'cotton'),
            'new_item' => __('New Project', 'cotton'),
            'view' => __('View Project', 'cotton'),
            'view_item' => __('View Project', 'cotton'),
            'search_items' => __('Search Project', 'cotton'),
            'not_found' => __('No projects found', 'cotton'),
            'not_found_in_trash' => __('No projects found in Trash', 'cotton')
        ),
        'public' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ), // Go to Dashboard Custom cotton Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));

}

function get_terms_by_post_type( $taxonomies, $post_types ) {
    global $wpdb;
    $query = $wpdb->get_results( "SELECT t.*, COUNT(*) from $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id WHERE p.post_type IN('".join( "', '", $post_types )."') AND tt.taxonomy IN('".join( "', '", $taxonomies )."') GROUP BY t.term_id");
    return $query;
}

function show_post_type_terms($taxonomy, $posttype = null ) {
   global $post;
   if(!isset($posttype)) $posttype = get_post_type( $post->ID );
   $terms = get_terms_by_post_type( array($taxonomy), array($posttype) );
   foreach($terms as $term) {
      $output = '<li class="filter" data-filter=' . $term->slug . '>'.$term->name.'</li>';
      echo $output;
   }
}

function searchfilter($query) {

    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('post','portfolio'));
    }

return $query;
}

add_filter('pre_get_posts','searchfilter');

function wpa82763_custom_type_in_categories( $query ) {
    if ( $query->is_main_query()
    && ( $query->is_category() || $query->is_tag() ) ) {
        $query->set( 'post_type', array( 'post', 'portfolio' ) );
    }
}
add_action( 'pre_get_posts', 'wpa82763_custom_type_in_categories' );

/*-------------------------------------------------------------------------------*/
/* Add Custom Icon for Portfolios 
/*-------------------------------------------------------------------------------*/
function custom_post_icons() { ?>
    <style type="text/css" media="screen">
        #menu-posts-portfolio .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/img/icons/portfolio-icon.png) no-repeat 6px 6px !important;
        }
        
        #menu-posts-sections .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/img/icons/sections-icon.png) no-repeat 6px 6px !important;
        }
        
		#menu-posts-portfolio:hover .wp-menu-image, 
		#menu-posts-portfolio.wp-has-current-submenu .wp-menu-image{
            background-position:6px -16px !important;
        }
        
		#menu-posts-sections:hover .wp-menu-image, 
		#menu-posts-sections.wp-has-current-submenu .wp-menu-image{
            background-position:6px -15px !important;
        }
        
		#icon-edit.icon32-posts-portfolio {
		    background: url(<?php echo get_template_directory_uri(); ?>/img/icons/portfolio-32x32.png) no-repeat 0 -4px;
		}
		
		#icon-edit.icon32-posts-sections {
		    background: url(<?php echo get_template_directory_uri(); ?>/img/icons/sections-32x32.png) no-repeat 0 -4px;
		}
    </style>
<?php }

add_action( 'admin_head', 'custom_post_icons' );

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function cotton_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function cotton_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

?>
