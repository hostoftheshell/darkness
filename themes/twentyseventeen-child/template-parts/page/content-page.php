<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @see https://codex.wordpress.org/Template_Hierarchy
 * @since 1.0
 *
 * @version 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><header class="">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		<?php twentyseventeen_edit_link(get_the_ID()); ?>
	</header><!-- .entry-header -->
	<div class="">
       
		<?php
        the_content();

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">'.__('Pages:', 'twentyseventeen'),
                    'after' => '</div>',
                )
            );
        ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->