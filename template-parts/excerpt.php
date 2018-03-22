<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wengroup
 */
?>
    <?php if( !is_singular() ) : ?>
            <div class="post-feed-title">
                <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 
                wengroup_the_category_list(); ?>
            </div><!--End 'post-feed-title'-->
	    <?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <?php  if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php wengroup_posted_by(); ?> | <?php wengroup_posted_on(); ?>

			<?php wengroup_edit_link(); ?>
		
			
        </div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content excerpt">
        
		<?php
			the_excerpt( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wengroup' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
			?>
			<div><a class="btn btn-read" href="<?php the_permalink(); ?>">Read More</a></div>

			<?php wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wengroup' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php wengroup_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
