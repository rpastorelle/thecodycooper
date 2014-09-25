<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */

get_header(); ?>

<section id="primary" class="site-content">
	<div id="content" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'oxygen' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'search' ); ?>

		<?php endwhile; ?>

		<?php oxygen_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

	<?php endif; ?>

	</div><!-- #content -->
</section><!-- #primary .site-content -->

<?php get_sidebar( 'primary' ); ?>

<?php get_sidebar( 'secondary' ); ?>

<?php get_footer(); ?>