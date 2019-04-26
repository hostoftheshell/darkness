<?php
/**
 * Enqueue scripts and styles.
 * 
 */
function darkness_scripts() {

    // Enqueue 'twentyseventeen-style'
    $parent_style = 'parent-style'; // This is 'twentyseventeen-style' for the Twenty Seventeen theme.
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css'
    );
    
    // Enqueue 'twentyseventeen-child-style'
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    
    // Enqueue Google Fonts: Lato, Quicksand, Yantramanav.
    wp_enqueue_style('darknessfont',
        'https://fonts.googleapis.com/css?family=Lato:300,300i|Quicksand:500|Yantramanav:900" rel="stylesheet'
    );

    wp_enqueue_script( 'darkness-script', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), '20180502', true );
}
add_action( 'wp_enqueue_scripts', 'darkness_scripts' );


/**
 * Increase number of front page sections in Twenty Seventeen.
 * 
 * @param int $num_sections Number of front page sections.
 */
add_filter( 'twentyseventeen_front_page_sections', function(){ return 10; } );



register_nav_menus(
    array(
        'left'    => __( 'Darkness Menu', 'twentyseventeen-child' ),
    )
);

/**
 *  Darkness Custom-Post-Types Plug-in.
 * 
 */
require get_stylesheet_directory() . '/inc/drknss-custom-posts.php';

/** 
 *  Enable categories & tags for attachments.
 * 
 */
function drknss_add_categories_to_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'drknss_add_categories_to_attachments' );

function drknss_add_tags_to_attachments() {
}
add_action( 'init' , 'drknss_add_tags_to_attachments' );

require_once get_stylesheet_directory() . '/inc/drknss-taxonomy.php';
/** 
 *  Add custom field to attachments.
 * 
 */
require_once get_stylesheet_directory() . '/inc/drknss-media-custom-fields.php';


/**
 * Darkness Widgets.
 */
require_once get_stylesheet_directory() . '/inc/drknss-widget-navigation.php';
require_once get_stylesheet_directory() . '/inc/drknss-widget-attachement-file.php';
require_once get_stylesheet_directory() . '/inc/drknss-widget-custom-link.php';

/**
 * Darkness Register Widgets.
 */
function drknss_register_widget() {
    register_widget('Drknss_Navigation_Widget');
    register_widget('Drknss_Attachment_File_Widget');
    register_widget('Drknss_Custom_Link_Widget');
    
}
add_action('widgets_init', 'drknss_register_widget');
/**
 * Darkness Register Sidebar .
 */
require_once get_stylesheet_directory() . '/inc/drknss-widget-area.php';
/**
 * Darkness Customize Color Picker.
 * 
 */
require_once get_stylesheet_directory() . '/inc/drknss-custom-colors.php';

/** 
 * Include custom darkness SVG sprite
 * 
 * */ 
function darkness_include_svg_icons() {
    // Define SVG sprite file.
    $custom_svg_icons = get_theme_file_path( '/assets/images/svg-custom-icons.svg' );
  
    // If it exists, include it.
    if ( file_exists( $custom_svg_icons ) ) {
      require_once( $custom_svg_icons );
    }
  }
  add_action( 'wp_footer', 'darkness_include_svg_icons', 99999 );
    
    // Append darkness SVG to the array of supported social link icons
    function childtheme_social_links_icons( $social_links_icons ) {
        $social_links_icons['thebookedition.com'] = 'quill';
        $social_links_icons['jfchenin.blogs'] = 'backward';
        return $social_links_icons;
      }
      add_filter( 'twentyseventeen_social_links_icons', 'childtheme_social_links_icons' );


      add_image_size( 'medium-height', 9999, 660 );


/**
 * SVG icons functions and filters.
 */
include_once( get_stylesheet_directory() . '/inc/social-menu-functions.php' );