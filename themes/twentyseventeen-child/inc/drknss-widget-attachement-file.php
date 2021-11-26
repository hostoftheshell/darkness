<?php

/**
 * Plugin Name:   Darkness Widget Attachment File
 * Plugin URI:
 * Description:       Adds a widget that displays the custom fields : `drknss_attached_file` and `drknss_attached_file_thumb`
 *        
 * Version:       1.0
 * Author:        Baptor Chenin
 * Author URI:    none
 */


class Drknss_Attachment_File_Widget extends WP_Widget
{
    
    // Set Up the Widget Name and Description.
    public function __construct()
    {
        $widget_options = array(
            'classname' => 'drknss_attachment_file_widget',
            'description' => __('Affiche le Lien de Téléchargement du Pdf correspondant à la saison# sur les différentes Pages \'Saison\' .')
        );
        parent::__construct('drknss_attachment_file', __('DARKNESS PDF SAISON'), $widget_options);
        
        
    }
    
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        return $instance;
    }
    
    public function widget($args, $instance)
    {
        
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                
                $field     = get_field('drknss_attached_file');
                $url       = wp_get_attachment_url($field);
                $filesize  = size_format(filesize(get_attached_file($field)));
                $path_info = pathinfo(get_attached_file($field));
                $image     = get_field('drknss_attached_file_thumb');
                $txt       = get_field(esc_html('drknss_attached_file_hyperlink'))?>

                    <a class="button" href="<?php echo esc_url($url);?>">
                        <div class="drknss-attachment-container">
                            <div class="drknss-attachment-thumb">
                                <?php
                if ($image):
                    echo wp_get_attachment_image($image, 'full');
                endif;
?>
                           </div>
                            <div class="drknss-attachment-link">
                            <?php
                if (isset($path_info['extension'])):
                    echo '<h6 class="drknss-attachment-text"> ' . $txt . ' </h6><p class="drknss-attachment-info"> [' . esc_html($path_info['extension']) . '  ' . esc_html($filesize) . ']</p>';
                endif;
?>
                           </div>
                        </div>
                    </a>
<?php
                
            }
        } 
    }
} 