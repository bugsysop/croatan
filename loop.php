<?php if ( have_posts() ) { ?>

	<?php while ( have_posts() ) { ?>

		<?php the_post(); // Loads the post data. ?>

		<?php
		      hybrid_get_content_template()
		?>

		<?php if ( is_singular() ) { ?>

			<?php comments_template(); // Loads the comments.php template. ?>

		<?php } // End if check. ?>

	<?php } // End while loop. ?>

<?php } else { ?>

	<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

<?php } // End if check. ?>