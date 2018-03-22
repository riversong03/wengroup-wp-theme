<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wengroup
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>
			<div class="row">
				<div class="col-md-8">
		<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				?>
				<div class="row post-feed">
					<div class="col-md-8">
						<div class="post-excerpt">
							<?php get_template_part( 'template-parts/excerpt', get_post_format() ); ?>
						</div><!--End 'post-excerpt'-->
					</div>
					<div class="col-md-4 post-feed-thumbnail">
						<div class="thumbnail"><?php wengroup_post_thumbnail(); ?></div>
					</div><!--End 'col-md-4'-->
				</div><!--End 'row'-->
		<?php

			endwhile;

			the_posts_pagination( array(
				'mid_size'=>2,
				'prev_text' => __( '<< Previous', 'wengroup' ),
				'next_text' => __( 'Next >>', 'wengroup' )
			));
			?>

			</div><!--End 'col-md-8'-->
			<?php get_sidebar(); ?>
			</div><!--End 'row'-->
			<?php
			

		else :

			get_template_part( 'template-parts/excerpt', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
