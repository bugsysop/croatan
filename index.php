<?php get_header(); // Loads the header.php template. ?>

	<!-- BEGIN #content -->
	<div id="content" class="hfeed">

		<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

		<?php get_template_part( 'loop' ); // Loads the loop.php template. ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	<!-- END #content -->
	</div>

<?php get_footer(); // Loads the footer.php template. ?>