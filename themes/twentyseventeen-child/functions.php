<?php
/**
 * ! Enqueue scripts and styles.
 */
function darkness_scripts()
{
    // * Enqueue 'twentyseventeen-style'
    $parent_style = 'parent-style'; // This is 'twentyseventeen-style' for the Twenty Seventeen theme.
    wp_enqueue_style($parent_style, get_template_directory_uri().'/style.css');
    // * Enqueue 'twentyseventeen-child-style'
    wp_enqueue_style('child-style', get_stylesheet_directory_uri().'/style.css', array($parent_style), wp_get_theme()->get('Version'));
    // * Enqueue Google Fonts: Lato, Quicksand, Yantramanav.
    wp_enqueue_style('darknessfont', 'https://fonts.googleapis.com/css?family=Lato:300,300i|Quicksand:300,500|Yantramanav:500|IBM+Plex+Serif:300i|IBM+Plex+Sans:200&display=swap" rel="stylesheet');
    wp_enqueue_script('darkness-script', get_stylesheet_directory_uri().'/assets/js/scripts.js', array('jquery'), '20180502', true);
}
//  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono:400,400i|IBM+Plex+Serif:400,400i&display=swap" rel="stylesheet"> 
add_action(
    'wp_enqueue_scripts', 'darkness_scripts'
);

/**
 *  * Increase number of front page sections in Twenty Seventeen.
 *  * @param int $num_sections Number of front page sections.
 */
add_filter('twentyseventeen_front_page_sections', function () {
    return 10;
});




register_nav_menus(
    array(
        'left'      => __( 'Darkness Menu', 'twentyseventeen-child' ),
        'info'      => __( 'Menu Info', 'twentyseventeen-child'),   
    )
);

/**
 * ! Darkness Custom-Post-Types Plug-in.
 */
require get_stylesheet_directory().'/inc/drknss-custom-posts.php';

/**
 * !  Enable categories & tags for attachments.
 */
function drknss_add_categories_to_attachments()
{
    register_taxonomy_for_object_type('category', 'attachment');
    
}
add_action('init', 'drknss_add_categories_to_attachments');
function drknss_add_tags_to_attachments()
{
}
add_action('init', 'drknss_add_tags_to_attachments');
require_once get_stylesheet_directory().'/inc/drknss-taxonomy.php';

/**
 * ! Add custom field to attachments.
 */
require_once get_stylesheet_directory().'/inc/drknss-media-custom-fields.php';

/**
 * ! Darkness Widgets.
 */
require_once get_stylesheet_directory().'/inc/drknss-widget-navigation.php';
require_once get_stylesheet_directory().'/inc/drknss-widget-attachement-file.php';
require_once get_stylesheet_directory().'/inc/drknss-widget-custom-link.php';

/**
 * ! Darkness Register Widgets.
 */
function drknss_register_widget()
{
    register_widget('Drknss_Navigation_Widget');
    register_widget('Drknss_Attachment_File_Widget');
    register_widget('Drknss_Custom_Link_Widget');
}
add_action('widgets_init', 'drknss_register_widget');

/**
 * ! Darkness Register Sidebar .
 */
require_once get_stylesheet_directory().'/inc/drknss-widget-area.php';

/**
 * ! Darkness Customize Color Picker.
 */
require_once get_stylesheet_directory().'/inc/drknss-custom-colors.php';

/**
 * ! Include custom darkness SVG sprite.
 */
function darkness_include_svg_icons()
{
    // Define SVG sprite file.
    $custom_svg_icons = get_theme_file_path('/assets/images/svg-custom-icons.svg');
    // If it exists, include it.
    if (file_exists($custom_svg_icons)) {
        require_once $custom_svg_icons;
    }
}
add_action('wp_footer', 'darkness_include_svg_icons', 99999);

// * Append darkness SVG to the array of supported social link icons
function childtheme_social_links_icons($social_links_icons)
{
    $social_links_icons['thebookedition.com'] = 'quill';
    $social_links_icons['jfchenin.blogs'] = 'backward';

    return $social_links_icons;
}
add_filter('twentyseventeen_social_links_icons', 'childtheme_social_links_icons');
add_image_size('medium-height', 9999, 660);

/**
 * ! SVG icons functions and filters.
 */
include_once get_stylesheet_directory().'/inc/social-menu-functions.php';

/**
 * ! Adding Custom Attributes To WordPress Menus.
 */
include_once get_stylesheet_directory().'/inc/drknss-custom-menu.php';

/**
 * 
 * Polotique de confidentialite 
 */

add_filter('wp_nav_menu_items', 'add_admin_link', 10, 2);
function add_admin_link($items, $args){
    if( $args->theme_location == 'info' && function_exists( 'the_privacy_policy_link' ) ){
        $items = $items . '<li><a href="'. get_privacy_policy_url() .'">Politique de confidentialité</a></li>';
    }
    return $items;
}
	

/**
 * ! Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
   }
   add_action( 'init', 'disable_emojis' );
   
/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
   
/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
   function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
   
   $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
   
   return $urls;
   }


/**
 * ! Mobile redirection 
 */
function darkness_mobile_home_redirect() {
    if( wp_is_mobile() && is_front_page() ) {
        $redirect_url = 'https://192.168.0.13:3000/wordpress/?page_id=25';
        header('Location: ' . esc_url_raw($redirect_url));
    }
}
add_action( 'template_redirect', 'darkness_mobile_home_redirect' );



/**
 * ! Infinite scroll blog page
 */
function misha_my_load_more_scripts() {
    
    if (is_home()) {
	global $wp_query; 
 
    
	// register our main script but do not enqueue it yet
	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/assets/js/myloadmore.js', array('jquery') );
   
	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'my_loadmore', 'misha_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'my_loadmore' );}
}
 
add_action( 'wp_enqueue_scripts', 'misha_my_load_more_scripts' );



function misha_loadmore_ajax_handler(){
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
 
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();
 
			// look into your theme code how the posts are inserted, but you can use your own HTML of course
			// do you remember? - my example is adapted for Twenty Seventeen theme
			get_template_part( 'template-parts/post/content', get_post_format() );
			// for the test purposes comment the line above and uncomment the below one
			// the_title();
 
 
		endwhile;
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
 
 
 
add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}