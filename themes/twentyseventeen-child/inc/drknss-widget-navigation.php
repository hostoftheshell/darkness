<?php
/**
 * Plugin Name:   Darkness Widget Plugin
 * Plugin URI:
 * Description:   Adds a widget that displays the navigation menu in a widget area.
 * 					
 * Version:       1.0
 * Author:        Baptor Chenin
 * Author URI:    none
 */

class Drknss_Navigation_Widget extends WP_Widget {

    // Set Up the Widget Name and Description.
    public function __construct() {
		$widget_options = array(
			'classname' => 'drknss_navigation_widget',
			'description' => __('Menu de Navigation de la Page d\'Accueil.')
		);
		parent::__construct('drknss_navigation', __('DARKNESS NAVIGATION'), $widget_options);
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
    return $instance;
	}

	// Create the Widget Outputs for the Current Recent Post Widget Instance.
	public function widget( $args, $instance ) {?>
      
		<div class="drknss-site-header" role="menu">
			<?php if ( has_nav_menu( 'left' ) ) : ?>
				<div class="navigation-left">
					<div class="drknss-wrap">
						<?php get_template_part( './template-parts/navigation/navigation', 'left' ); ?>
					</div><!-- .drknss-wrap -->
				</div><!-- .navigation-left -->
			<?php endif; ?>
		</div><!-- .drknss-site-header -->
		<?php
	}
}
    

    