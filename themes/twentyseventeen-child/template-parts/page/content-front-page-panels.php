<?php
/**
 * Template part for displaying pages on front page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

global $twentyseventeencounter;

?>

<article id="panel<?php echo $twentyseventeencounter; ?>" <?php post_class( 'twentyseventeen-panel ' ); ?> >

	<?php
	/* darkness tweak : Add an id to <div class:"panel-content"> that follow the created setting and control from Twenty Seventeen in front-page.php */
	$darknesscounter = $twentyseventeencounter - 1; ?>

	<div id="saison-0<?php echo $twentyseventeencounter; ?>" class="panel-content">
		
		
		<div class="wrap drknss-wrap">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
				
				<?php // twentyseventeen_edit_link( get_the_ID() ); ?>
				
			</header><!-- .entry-header -->
			

			<div class="entry-content">
				<?php
				/* darkness tweak: not displaying the content of the page in front page section */
				if (! is_front_page()) :
					/* translators: %s: Name of current post */
					the_content(
						sprintf(
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
							get_the_title()
						)
					);
				endif;
				
				/* darkness tweak: display a random image based on the custom taxonomy 'saison' in each front page section  */	
				$images = get_posts( array(
					'post_type' 		=> 'attachment',
					'orderby'        	=> 'rand',
    				'posts_per_page' 	=> '1', 
					'tax_query' 		=> array(
						array(
							'taxonomy' 		=> 'saison',
							'field' 		=> 'slug',
							'terms' 		=> 'saison 0' . $twentyseventeencounter
						),
					),
				));
						
				if ( !empty($images) ) {
					foreach ( $images as $image ) {
							//print_r($image_attr = wp_get_attachment_image_src($image->ID));
							//echo wp_get_attachment_image($image->ID);
							$img_size = wp_get_attachment_image_src($image->ID, 'full');
							if ($img_size[2] > 1000) {
								echo '<img src="' . wp_get_attachment_image_url($image->ID, 'medium-height') . '">';
							} 
							else {
								echo '<img src="' . wp_get_attachment_image_url($image->ID, 'full') . '">'; 
							}
							
							echo get_post_meta($image->ID, 'drknss-mv-prefix', true) . get_post_meta($image->ID, 'drknss-mv-number', true);
						}
					} ?>
				</div><!-- .entry-content -->

			<?php
			// Show recent blog posts if is blog posts page (Note that get_option returns a string, so we're casting the result as an int).
			if ( get_the_ID() === (int) get_option( 'page_for_posts' ) ) :
			?>

				<?php
				// Show three most recent posts.
				$recent_posts = new WP_Query(
					array(
						'posts_per_page'      => 3,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
						'no_found_rows'       => true,
					)
				);
				?>

				<?php if ( $recent_posts->have_posts() ) : ?>

					<div class="recent-posts">

						<?php
						while ( $recent_posts->have_posts() ) :
							$recent_posts->the_post();
							get_template_part( 'template-parts/post/content', 'excerpt' );
						endwhile;
						wp_reset_postdata();
						?>
					</div><!-- .recent-posts -->
				<?php endif; ?>
			<?php endif; ?>
		</div><!-- .wrap -->
	</div><!-- .panel-content -->
<?php
	if ( has_post_thumbnail() ) :
		$thumbnail = wp_get_attachment_image_src($image->ID, 'full' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail[2] / $thumbnail[1] * 100;
		
		?>
	<div class="box">
		<div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<div class="panel-image-prop" style="padding-left: <?php echo esc_attr( $ratio ); ?>%"></div>
		</div><!-- .panel-image -->
	</div>
	<?php endif; ?>
	
</article><!-- #post-## -->

