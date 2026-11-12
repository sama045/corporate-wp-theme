<article>
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<div class="thumbnail"><?php the_post_thumbnail(); ?></div>
		<div class="content">
            <div class="tophead container">
                <?php $topic_h1 = get_field('topic_h1'); ?>
                <h1 data-aos="zoom-in" data-aos-easing="linear" data-aos-duration="1500">
                    <?php if($topic_h1):
                    echo ( $topic_h1 );
                    endif;
                    ?> 
                </h1>
                <p class="intro-buttons">
                    <?php 
                    $cta_1 = get_field('cta_1');
					$cta_2 = get_field('cta_2');
                    
                    if( $cta_1 ): 
                        $cta1_url = $cta_1['url'];
                        $cta1_title = $cta_1['title'];
                        $cta1_target = $cta_1['target'] ? $cta_1['target'] : '_self';
                        ?>
                        <a class="button button-red" href="<?php echo esc_url( $cta1_url ); ?>" target="<?php echo esc_attr( $cta1_target ); ?>"><?php echo esc_html( $cta1_title ); ?></a>
                    <?php endif; ?>
                    
                    <?php if( $cta_2 ): 
                        $cta2_url = $cta_2['url'];
                        $cta2_title = $cta_2['title'];
                        $cta2_target = $cta_2['target'] ? $cta_2['target'] : '_self';
                        ?>
                        <a class="button button-default" href="<?php echo esc_url( $cta2_url ); ?>" target="<?php echo esc_attr( $cta2_target ); ?>"><?php echo esc_html( $cta2_title ); ?></a>
                    <?php endif; ?>
                </p>
            </div>
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
	<?php endif; ?>
</article>