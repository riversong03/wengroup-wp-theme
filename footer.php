<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wengroup
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<nav class="footer-nav">
			<div class="bottom-nav">
				<h6>Quick Links</h6>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'footer-menu' ) );
			?>
			</div>
			
		</nav><!--End 'footer-nav'-->
		<div class="site-info">
		
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wengroup' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'wengroup' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'wengroup' ), 'wengroup', '<a href="http://wengroupllc.com">Jill Wen</a>' );
			?>

			
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
