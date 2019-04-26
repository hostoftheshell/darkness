<?php
/*
* Plugin Name: Media Upload Widget
* Plugin URI: http://www.paulund.co.uk
* Description: A widget that allows you to upload media from a widget
* Version: 1.0
* Author: Paul Underwood
* Author URI: http://www.paulund.co.uk
* License: GPL2

Copyright 2012  Paul Underwood

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License,
version 2, as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/
/**
 * Register the Widget
 */

 class Drknss_Custom_Link_Widget extends WP_Widget {

    public function __construct() {
		$widget_options = array(
			'classname' => 'drknss_custom_link_widget',
			'description' => __('Éditer et Afficher une image ainsi qu\'un lien url.')
		);
        parent::__construct('drknss_custom_link', __('DARKNESS LINK'), $widget_options);
    

        add_action('admin_enqueue_scripts', array($this, 'scripts'));
    
    }

    /**
     * Upload the Javascripts for the media uploader
     */
 
    public function scripts()
{
   wp_enqueue_script( 'media-upload' );
   wp_enqueue_media();
   wp_enqueue_script('upload_media_widget', get_stylesheet_directory_uri() . '/assets/js/upload-media.js', array('jquery'));

}

  
    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    public function widget( $args, $instance ) {
        // Our variables from the widget settings
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Default title', 'text_domain' ) : $instance['title'] );
        $url = apply_filters( 'widget_url', empty( $instance['url'] ) ? __( 'Default url', 'text_domain' ) : $instance['url'] );
        $image = ! empty( $instance['image'] ) ? $instance['image'] : '';

      
        ob_start();
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
           echo $args['before_title'] . '<a href=' . $instance['url'] . '>' . $instance['title'] . '</a>' . $args['after_title'];
        }
        ?>
      
        <?php if($image): ?>
           <img src="<?php echo esc_url($image); ?>" alt="">
        <?php endif; ?>
      
        <?php
        echo $args['after_widget'];
        ob_end_flush();
     }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
      
        return $instance;
     }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void
     **/
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
        $url = ! empty( $instance['url'] ) ? $instance['url'] : __( 'New url', 'text_domain' );
        $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
        ?>
        <p>
           <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
           <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
           <label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Url:' ); ?></label>
           <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
        </p>
        <p>
           <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
           <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
           <button class="upload_image_button button button-primary">Upload Image</button>
        </p>
        <?php
     }
}
?>