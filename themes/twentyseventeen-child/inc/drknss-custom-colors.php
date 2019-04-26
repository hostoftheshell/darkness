<?php

/**
 * Darkness Customize Color Picker.
 * 
 */

function darkness_setup_theme_features() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'grayish vermilion', 'darkness' ),
            'slug' => 'grayish-vermilion',
            'color' => '#c5b3ab',
        ),
        array(
            'name' => __( 'vermilionish gray', 'darkness' ),
            'slug' => 'vermilionish-gray',
            'color' => '#ceb0a8',
        ),
        array(
            'name' => __( 'drknss tangelo', 'darkness' ),
            'slug' => 'drknss-tangelo',
            'color' => '#b59684',
        ),
        array(
            'name' => __( 'mulberryish', 'darkness' ),
            'slug' => 'mulberryish',
            'color' => '#7e6a85',
        ),
        array(
            'name' => __( 'cornflower black', 'darkness' ),
            'slug' => 'cornflower-black',
            'color' => '#191d1f',
        ),
        array(
            'name' => __( 'cornflower blue dark', 'darkness' ),
            'slug' => 'cornflower-blue-dark',
            'color' => '#2b3b45',
        ),
        array(
            'name' => __( 'cornflower blue light', 'darkness' ),
            'slug' => 'cornflower-blue-light',
            'color' => '#80b2c9',
        ),
        array(
            'name' => __( 'drknss cyan', 'darkness' ),
            'slug' => 'drknss-cyan',
            'color' => '#00908e',
        ),
        array(
            'name' => __( 'drknss azure', 'darkness' ),
            'slug' => 'drknss-azure',
            'color' => '#5a7088',
        ),
        array(
            'name' => __( 'drknss cerulean', 'darkness' ),
            'slug' => 'drknss-cerulean',
            'color' => '#647d86',
        ),
        array(
            'name' => __( 'yellowish', 'darkness' ),
            'slug' => 'yellowish',
            'color' => '#eff0dd',
        ),
        array(
            'name' => __( 'drknss red', 'darkness' ),
            'slug' => 'drknss-red',
            'color' => '#b23539',
        ),
        array(
            'name' => __( 'drknss scarlet', 'darkness' ),
            'slug' => 'drknss-scarlet',
            'color' => '#f4665b',
        ),
        array(
            'name' => __( 'sea green light', 'darkness' ),
            'slug' => 'sea-green-light',
            'color' => '#a2b0a8',
        ),
        array(
            'name' => __( 'sea green dark', 'darkness' ),
            'slug' => 'sea-green-dark',
            'color' => '#587762',
        ),
        array(
            'name' => __( 'drknss gamboge', 'darkness' ),
            'slug' => 'drknss-gambodge',
            'color' => '#f19b23',
        ),
    ) );
}

add_action( 'after_setup_theme', 'darkness_setup_theme_features' );