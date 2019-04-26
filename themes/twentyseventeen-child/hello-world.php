<?php
/*
 * Template Name: helloworld
 * Template Post Type: post, page, product
 */
?>

<?php
get_header();
?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
            the_post();
            


			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
       
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
