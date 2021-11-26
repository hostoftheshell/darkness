<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-info">
<?php
	
	wp_nav_menu(
		array(
			'theme_location' => 'info',
			'menu_class'	 => 'menu-info',
			'item_wraper' => '<ul id ="info_menu" class="%2$s">3$s</ul>',
		)
	); ?>



	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentyseventeen' ) ); ?>" class="imprint">
		<?php printf( __( 'Proudly powered by %s', 'twentyseventeen' ), 'WordPress' ); ?>
	</a>
</div><!-- .site-info -->
