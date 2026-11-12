<?php get_header(); ?>

	<main role="main">

		<article class="one-page container flex">

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<div class="col-2">

		<?php the_content(); ?>
		<p class="intro-buttons">
            <a href="<?php echo home_url(); ?>/contact-us/" class="button button-default">contact us</a>
        </p>
		<div class="flexslider">
			<ul class="slides">
				<?php 
				$args = array (
			        'post_type' => 'post',
			        'category_name' => 'carees',
			        'order' => 'ASC'
			    );
				$custom = new WP_Query( $args ); ?>
				<?php if ( $custom->have_posts() ) : while ( $custom->have_posts() ) : $custom->the_post(); ?>
				<li>
					<div class="flex-caption">
						<p><span class="title"><?php the_title(); ?></span></p>
						<?php the_content(); ?>
					</div>
				</li>
				<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</ul>				
		</div>
		
        <?php edit_post_link(); ?>
        </div>
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
