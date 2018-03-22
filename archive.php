<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wengroup
 */

get_header(); ?>

	<div id="primary" class="content-area flex-container">
		<div class="row">
			<main id="main" class="site-main col-md-8">

			<?php
			if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->

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

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
			<?php get_sidebar(); ?>
		</div><!--End 'row'-->
	</div><!-- #primary -->

<?php

get_footer();
