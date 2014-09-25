<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Oxygen
 * @since Oxygen 0.2.2
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" role="main">

	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php oxygen_content_nav( 'nav-below' ); ?>

	<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

		<?php get_template_part( 'no-results', 'index' ); ?>

	<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary .site-content -->

<?php get_sidebar( 'primary' ); ?>

<?php get_sidebar( 'secondary' ); ?>

<?php get_footer(); ?>