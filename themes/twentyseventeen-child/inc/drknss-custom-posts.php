<?php
/**
 * Plugin Name: Darkness Custom Post Types
 * Description: Custom Post Types for "Darkness" website.
 * Author : B. Chenin
 */

add_action('init', 'drknss_create_post_type');

function drknss_create_post_type() {
    register_post_type('drknss-quotation-cpt', array (
        'label'         => "Citation",
        'labels'        => array (
            'name'          => 'Citations',
            'singular_name' => 'Citation'
        ),
        'description' => "Éditer les informations du Widget Citation",

        'public'        => true,
        'menu_position' => 30,
        'has_archive'   => true,
        'supports'      => array (
            'title',
            'custom-fields'
        )
    ));
}