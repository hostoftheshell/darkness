<?php

/**
 * Register widget area.
 *
 * @link https: //developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

 add_action( 'widgets_init', 'drknss_widgets_init' );
	function drknss_widgets_init() {
		$my_sidebars = array(
			array(
				'name'        => __( 'Navigation Sidebar', 'darkness' ),
				'id'          => 'drknss-navigation',
				'description' => __( 'Ajoutez ici le widget DARKNESS NAVIGATION pour que le menu apparaisse dans votre page d\'accueil.', 'darkness' )
    		),
    		array(
				'name'        => __( 'Pied de page 3', 'darkness' ),
				'id'          => 'sidebar-4',
				'description' => __( 'Ajoutez ici des widgets qui apparaîtront dans votre pied de page.', 'darkness' )
			),
		);

  		$defaults = array(
			  'name'          => 'Darkness Sidebar',
			  'id'            => 'Darkness Sidebar',
			  'description'   => 'The Awesome Sidebar is shown on the left hand side of blog pages in this theme',
			  'before_widget' => '<section id="%1$s" class="widget %2$s">',
			  'after_widget'  => '</section>',
			  'before_title'  => '<h2 class="widget-title">',
			  'after_title'   => '</h2>'
  		);

  		foreach( $my_sidebars as $sidebar ) {
			  $args = wp_parse_args( $sidebar, $defaults );
			  register_sidebar( $args );
		}
	}
 
 ?>