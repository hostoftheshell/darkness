<?php
/**
 * Register custom taxonomy which applies to attachments
 * 
 */

function dkrnss_add_saison_taxonomy() {
    $labels = array(
        'name'              => 'Saisons',
        'singular_name'     => 'Saison',
        'all_items'         => 'All Saisons',
        'parent_item'       => 'Parent Saison',
        'parent_item_colon' => 'Parent Saison:',
        'edit_item'         => 'Edit Saison',
        'update_item'       => 'Update Saison',
        'add_new_item'      => 'Add New Saison',
        'new_item_name'     => 'New Saison Name',
        'menu_name'         => 'Saison',

    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false,
        'query_var'         => true,
        'rewrite'           => true,
        'show_admin_column' => true,
    );
 
    register_taxonomy( 'saison', 'attachment', $args );
}
add_action( 'init', 'dkrnss_add_saison_taxonomy' );

/**
 * Register custom taxonomy which applies to pages
 * 
 */

function dkrnss_add_type_taxonomy() {
    $labels = array(
        'name'              => 'Types de pages',
        'singular_name'     => 'Type de page',
        'all_items'         => 'All Types',
        'parent_item'       => 'Parent Type',
        'parent_item_colon' => 'Parent Type:',
        'edit_item'         => 'Edit Type',
        'update_item'       => 'Update Type',
        'add_new_item'      => 'Add New Type',
        'new_item_name'     => 'New Type Name',
        'menu_name'         => 'Type',
        

    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'drknss-feature' ),
        'show_admin_column' => true,
        'public'            => true,
        // 'show_in_rest' => true,
    );
 
    register_taxonomy( 'type', 'page', $args );
}
add_action( 'init', 'dkrnss_add_type_taxonomy', 5 );





