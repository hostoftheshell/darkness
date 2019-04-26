<?php

/**
 * Add Custom Field (Monument Valley Number) to Media
 */
add_filter( 'attachment_fields_to_edit', 'darkness_attachment_fields', 10, 2 );
function darkness_attachment_fields( $fields, $post ) {
    
    $mv_prefix = get_post_meta($post->ID, 'drknss-mv-prefix', 'MV', true);
    $mv_number = get_post_meta( $post->ID, 'drknss-mv-number', true );
    $mv_title = get_post_meta( $post->ID, 'drknss-mv-title', true );
    
    $fields = array(
        'drknss-mv-prefix' => array(
            'label' =>  __( 'Préfix Monument Valley', 'text-domain' ),
            'input' => 'text',
            'value' => $mv_prefix,
            'show_in_edit' => true,
            'helps' => 'Si le champs est laissé <strong>vide</strong> au moment de la publication,<br>le préfix <strong>MV</strong> est inscrit par défaut'
        ),
        'drknss-mv-number' => array(
            'label' =>  __( 'Numéro Monument Valley', 'text-domain' ),
            'input' => 'text',
            'value' => $mv_number,
            'show_in_edit' => true,
            
        ),
        'drknss-mv-title' => array(
            'label' =>  __( 'Titre Monument Valley', 'text-domain' ),
            'input' => 'text',
            'value' => $mv_title,
            'show_in_edit' => true,
        ),
    );
    
    return $fields;         
}

add_action('wp_insert_post', 'set_default_custom_fields');
function set_default_custom_fields($post_id){
if ( $_GET['post_type'] == 'post' ) {
add_post_meta($post_id, 'Field Name', 'Field Value', true);
}
return true;
}

/**
 * Update Custom Field within Media Overlay (via ajax)
 */
add_action( 'wp_ajax_save-attachment-compat', 'darkness_media_fields', 0, 1 );
function darkness_media_fields() {
    $post_id = $_POST['id'];
    
    $mv_prefix = $_POST['attachments'][ $post_id ]['drknss-mv-prefix'];
    update_post_meta( $post_id , 'drknss-mv-prefix', $mv_prefix );
    
    $mv_number = $_POST['attachments'][ $post_id ]['drknss-mv-number'];
    update_post_meta( $post_id , 'drknss-mv-number', $mv_number );
    
    $mv_title = $_POST['attachments'][ $post_id ]['drknss-mv-title'];
    update_post_meta( $post_id , 'drknss-mv-title', $mv_title );

    clean_post_cache( $post_id );
}

/**
 * Update Media Custom Field from Edit Media Page (non ajax)
 */
add_action( 'edit_attachment', 'darkness_update_attachment_meta', 1 );
function darkness_update_attachment_meta( $post_id ) {
    
    $mv_prefix = isset( $_POST['attachments'][ $post_id ]['drknss-mv-prefix'] ) ? $_POST['attachments'][ $post_id ]['drknss-mv-prefix'] : false;
    if (empty($mv_prefix)) {
        
        update_post_meta( $post_id , 'drknss-mv-prefix', 'MV' );
    } else {
    update_post_meta( $post_id , 'drknss-mv-prefix', $mv_prefix );
    }
    
    
    $mv_number = isset( $_POST['attachments'][ $post_id ]['drknss-mv-number'] ) ? $_POST['attachments'][ $post_id ]['drknss-mv-number'] : false;
    update_post_meta( $post_id, 'drknss-mv-number', $mv_number );
    
    $mv_title = isset( $_POST['attachments'][ $post_id ]['drknss-mv-title'] ) ? $_POST['attachments'][ $post_id ]['drknss-mv-title'] : false;
    update_post_meta( $post_id, 'drknss-mv-title', $mv_title );
    return;
}

/**
 * Add a sortable (MV#) to the Media Library
 */
if( is_admin()){
    add_filter( 'manage_upload_columns', 'drknss_columns_attachment_mv_number_register' );
    add_action('manage_media_custom_column', 'drknss_custom_columns_attachment_mv_number', 1, 2);
    add_filter( 'manage_upload_sortable_columns', 'drknss_mv_number_columns_sortable' );
    add_action( 'pre_get_posts', 'drknss_mv_number_orderby' );
    
}
/* Register Darkness MV# Column */
function drknss_columns_attachment_mv_number_register( $columns ) {
    $columns['drknss-mv-number'] = __('MV#');
    
    return $columns;
}

/* Display Darkness MV# Column */
function drknss_custom_columns_attachment_mv_number($column_name, $id){
    if($column_name === 'drknss-mv-number')
    
    echo '<strong>' . get_post_meta($id,'drknss-mv-number',true) . '</strong>' . '<br>' . '<em>' . get_post_meta($id,'drknss-mv-title',true) . '</em>';
}


/* Make Darkness MV# Column Sortable */
function drknss_mv_number_columns_sortable( $columns ) {
    $columns['drknss-mv-number'] = 'drknss-mv-numbers';
        
    return $columns;
}


function drknss_mv_number_orderby( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get( 'orderby');
 
    if( 'drknss-mv-numbers' == $orderby ) {
        $query->set('meta_key','drknss-mv-number');
        $query->set('orderby','meta_value_num');
    }
}





?>