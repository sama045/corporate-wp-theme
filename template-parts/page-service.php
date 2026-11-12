<?php get_header(); ?>

	<main role="main">

		<article class="service-page one-page container flex">

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<div class="flexslider">
			<ul class="slides">
				<?php 
				$custom_args = array (
			        'post_type' => 'post',
			        'category_name' => 'services',
			        'order' => 'ASC'
			    );
				$custom_query = new WP_Query( $custom_args ); ?>
				<?php if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
				<li>
					<div class="flex-caption">
						<p><?php echo get_field( 'icon' ); ?></p>
						<p><span class="title"><?php the_title(); ?></span></p>
						<?php the_content(); ?>
					</div>
				</li>
				<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
				<?php edit_post_link(); ?>
		</div>
		<p class="intro-buttons">
            <a href="<?php echo home_url(); ?>/contact-us/" class="button button-default">contact us</a>
        </p>
		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		</article>
	</main>
<?php get_footer(); ?>
