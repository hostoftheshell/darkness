<?php
/**
 * Template part for displaying pages on front page.
 *
 * @since 1.0
 *
 * @version 1.0
 */
global $twentyseventeencounter;
/**
* * darkness tweak : Add an id to <div class:"panel-content"> that follow the created setting and control from Twenty Seventeen in front-page.php
*/

$darknesscounter = $twentyseventeencounter - 1;
?>

    <article id="panel<?php echo $twentyseventeencounter; ?>" <?php post_class('twentyseventeen-panel '); ?> >
        <div id="saison-0<?php echo $twentyseventeencounter; ?>" class="panel-content">
        <?php

            /* darkness tweak: not displaying the content of the page in front page section */
            if (!is_front_page()):   /* translators: %s: Name of current post */
            the_content(sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen'), get_the_title()));
            endif;

            /* darkness tweak: display a random image based on the custom taxonomy 'saison' in each front page section  */
            $images = get_posts(array(
                'post_type' => 'attachment',
                'orderby' => 'rand',
                'posts_per_page' => '1',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'saison',
                        'field' => 'slug',
                        'terms' => 'saison 0'.$twentyseventeencounter,
                    ),
                ),
            ));

            if (!empty($images)) {
                foreach ($images as $image) {
                    //print_r($image_attr = wp_get_attachment_image_src($image->ID));
                    //echo wp_get_attachment_image($image->ID);
                    $alt_text = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
                    $img_size = wp_get_attachment_image_src($image->ID, 'full');

                    if ($img_size[2] > 970) {
                        ?>
            
            <div class = "wrap drknss-wrap medium-wrap">
                <div class = "entry-content">
                   <div class = "content-wrap">
                        <?php echo '<img loading="eager" src="'.wp_get_attachment_image_url($image->ID, 'medium-height').'" alt="'.$alt_text.'">';
                    } else {
                        ?>
                    
            <div class = "wrap drknss-wrap full-wrap">
                <div class = "entry-content">
                    <div class = "content-wrap">
                        <?php echo '<img src="'.wp_get_attachment_image_url($image->ID, 'full').'" alt="'.$alt_text.'">';
                    } ?>
                        <div class = "mv-prefix">
                            <?php echo get_post_meta($image->ID, 'drknss-mv-prefix', true).get_post_meta($image->ID, 'drknss-mv-number', true);
                }
            }?>
                        </div><!-- .mv-prefix -->
                    </div><!-- .content-wrap -->
                </div><!-- .entry-content -->

                <?php
            // Show recent blog posts if is blog posts page (Note that get_option returns a string, so we're casting the result as an int).
            if (get_the_ID() === (int) get_option('page_for_posts')) :
                ?>

				<?php
                // Show three most recent posts.
                $recent_posts = new WP_Query(
                    array(
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => true,
                        'no_found_rows' => true,
                    )
                );
                ?>

				<?php if ($recent_posts->have_posts()) : ?>

					<div class="recent-posts">

						<?php
                        while ($recent_posts->have_posts()) :
                            $recent_posts->the_post();
                            get_template_part('template-parts/post/content', 'excerpt');
                        endwhile;
                        wp_reset_postdata();
                        ?>
					</div><!-- .recent-posts -->
				<?php endif; ?>
			<?php endif; ?>
                                   
            </div><!-- .wrap -->
        </div><!-- .panel-content -->
 
    
           
                <header class="entry-header">
                    <div class="darkness-page-link">
                        <a href="" class="saison-page-link">
                            <div class="page-link-first">
                                <svg class="icon drknss-icon">
								    <use xlink:href="#icon-arrow"></use>
                                </svg>
                            </div>
                            <div class="page-link-second">
                                 <?php the_title('<h2 class="entry-title">', '</h2>');?>
                            </div>
                        </a>
                    <?php// twentyseventeen_edit_link( get_the_ID() );?>
                    </div>
                </header><!-- .entry-header -->
                
               
            
<?php 
    if (has_post_thumbnail()):
        $thumbnail = wp_get_attachment_image_src($image->ID, 'full');
        // Calculate aspect ratio: h / w * 100%.
        $ratio = $thumbnail[2] / $thumbnail[1] * 100; 
        ?>
         <div class="panel-image" style="background-image: url(<?php echo esc_url($thumbnail[0]); ?>);">
                    <div class="panel-image-prop" style="padding-left: <?php echo esc_attr($ratio); ?>%"></div>
                </div><!-- .panel-image -->
    <?php endif; ?>

    </article>
    
    <!-- #post-## -->
    
	