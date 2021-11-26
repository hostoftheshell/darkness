<?php
/**
 * Displays left navigation
 *
 * @package WordPress
 * @subpackage Darkness
 * @since 1.0
 * @version 1.0
 */
if ( !(is_home()) && is_front_page() ) : ?>
<nav id="drknss-site-navigation" class="drknss-main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Left Menu', 'twentyseventeen' ); ?>">
	<button class="menu-toggle" aria-controls="left-menu" aria-expanded="false">
		<?php
		echo twentyseventeen_get_svg( array( 'icon' => 'bars' ) );
		echo twentyseventeen_get_svg( array( 'icon' => 'close' ) );
		_e( 'Menu', 'twentyseventeen' );
		?>
	</button>

	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'left',
			'menu_id'        => 'left-menu',
			'menu_class'	 => 'menu-bar',
			'walker' => new rc_scm_walker
		)
	);
	?>
</nav><!-- #site-navigation -->
<?php endif; ?>