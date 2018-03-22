<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package wengroup
 */

get_header(); ?>

	<section id="primary" class="content-area flex-container">
		<div class="row">
			<main id="main" class="site-main col-md-8">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'wengroup' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				?>
				<div class="row search-results">
					<div class="col-md-8">
					<?php get_template_part( 'template-parts/excerpt', 'search' ); ?>

					</div>
					<div class="col-md-4 post-feed-thumbnail">
						<div class="thumbnail"><?php wengroup_post_thumbnail(); ?></div>
					</div><!--End 'col-md-4'-->
				</div><!--End 'row'-->
				<?php

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/excerpt', 'none' );

		endif; ?>

			</main><!-- #main -->
			<?php get_sidebar(); ?>
		</div><!--End 'row'-->
	</section><!-- #primary -->

<?php

get_footer();
