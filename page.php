<?php get_header(); ?>

<?php if (is_front_page()) {
	get_template_part('template-parts/page','home');
} elseif (is_page('service')) {
	get_template_part('template-parts/page','service');
} elseif (is_page('careers')) {
	get_template_part('template-parts/page','carees');
} else {
	?>

	<main role="main">
		<?php if ( has_post_thumbnail()) : ?>

		<?php get_template_part('template-parts/page','has-thumb'); ?>
			
		<?php else: ?>
		
		<article class="one-page container flex">			

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<section id="post-<?php the_ID(); ?>" <?php post_class('col-2'); ?>>

				<h1 data-aos="zoom-in" data-aos-easing="linear"  data-aos-duration="1500"><?php the_title(); ?></h1>

				<?php the_content(); ?>

				<br class="clear">

				<?php edit_post_link(); ?>

			</section>

		<?php endwhile; ?>

		<?php else: ?>
			<section>

				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</section>

		<?php endif; ?>
		<?php endif; ?>
		</article>
	</main>
<?php } ?>
<?php get_footer(); ?>
