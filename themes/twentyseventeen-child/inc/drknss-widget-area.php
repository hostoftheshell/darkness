<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function drknss_widgets_init() {
	register_sidebar( 
        array(
		    'name'          => esc_html__( 'Navigation Sidebar', 'darkness' ),
		    'id'            => 'drknss-navigation',
		    'description'   => esc_html__( 'Add DARKNESS NAVIGATION widgets here to appear in your front page.', 'darkness' ),
		    'before_widget' => '<section id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</section>',
		    'before_title'  => '<h2 class="widget-title">',
		    'after_title'   => '</h2>',
        ) 
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Pied de page 3', 'darkness' ),
			'id'            => 'sidebar-4',
			'description'   => __( 'Add widgets here to appear in your footer.', 'darkness' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'drknss_widgets_init' );