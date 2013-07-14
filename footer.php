<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Croatan
 * @since Croatan 0.1
 */
?>
		<p id="back-top"><a href="#top"><span></span>Back to Top</a></p>

			<?php get_sidebar( 'primary' ); 				// Loads the sidebar-primary.php template. ?>
			<?php get_sidebar( 'secondary' ); 				// Loads the sidebar-secondary.php template. ?>

		<!-- END #main -->
		</section>

		<?php get_sidebar( 'subsidiary' ); 					// Loads the sidebar-subsidiary.php template. ?>

		<!-- BEGIN #site-footer -->
		<footer id="site-footer" role="contentinfo">

				<div class="footer-content">
					<?php echo apply_atomic_shortcode( 'footer_content', '<p class="site-info">' . __( 'Copyright &copy; [the-year] [site-link]. Powered by [wp-link] and [theme-link].', 'croatan' ) . '</p>' ); ?>
				</div><!-- .footer-content -->

		<!-- END #site-footer -->
		</footer>

	<!-- END #container -->
	</div>

	<?php wp_footer(); ?>

<!-- END body -->
</body>
</html>