<?php get_header(); ?>

	<main role="main">

		<article class="first-page one-page container flex">

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<div class="col-2">		
			<h1 data-aos="zoom-in" data-aos-easing="linear"  data-aos-duration="1500"><?php the_title(); ?></h1>		
				<?php
// 1. ดึงข้อมูลดิบจาก ACF (สมมติว่าได้สตริง "รักษาสิว, เลเซอร์หน้าใส, ทรีทเมนท์")
$raw_words = get_field('typewriter_words');

// 2. เตรียมตัวแปร $words_array และเช็กว่ามีข้อมูลหรือไม่
$words_array = array();

if ( ! empty( $raw_words ) ) {
    // 3. ใช้ explode() เพื่อแยกข้อความด้วยลูกน้ำ (,) ให้กลายเป็น Array
    // เช่น array('รักษาสิว', ' เลเซอร์หน้าใส', ' ทรีทเมนท์')
    $exploded_words = explode(',', $raw_words);

    // 4. ใช้ array_map() ร่วมกับ 'trim' เพื่อตัดช่องว่างหน้า/หลังคำเผื่อแอดมินพิมพ์เว้นวรรค
    // ผลลัพธ์: array('รักษาสิว', 'เลเซอร์หน้าใส', 'ทรีทเมนท์')
    $words_array = array_map('trim', $exploded_words);
} else {
    // 5. กรณีที่แอดมินลืมใส่ข้อมูล เราควรมีค่า Default (Fallback) ป้องกันเว็บพัง
    $words_array = array('Software Development', 'Web Design', 'SEO Services');
}

// 6. แปลง Array เป็น JSON String เพื่อเตรียมยัดใส่ Attribute data-words
$words_json = wp_json_encode( $words_array );
?>
<p><span class="type-cursor" data-wait="2500" data-words="<?php echo esc_attr( $words_json ); ?>">
	<span id="typer"></span>
</span></p>

<?php the_content(); ?>

<p class="intro-buttons">

<?php 

$intro_buttons = get_field('intro-buttons');

if( $intro_buttons ):
	
	$link_1 = $intro_buttons['link_1'];
	$link_2 = $intro_buttons['link_2'];
    
    if( $link_1 ): 
        $p_url    = $link_1['url'];
        $p_title  = $link_1['title'];
        $p_target = $link_1['target'] ? $link_1['target'] : '_self';
    ?>
        <a class="button button-red" href="<?php echo esc_url( $p_url ); ?>" target="<?php echo esc_attr( $p_target ); ?>">
            <?php echo esc_html( $p_title ); ?>
        </a>
    <?php endif; ?>	
	<?php  

    if( $link_2 ): 
        $s_url    = $link_2['url'];
        $s_title  = $link_2['title'];
        $s_target = $link_2['target'] ? $link_2['target'] : '_self';
    ?>
        <a class="button button-default" href="<?php echo esc_url( $s_url ); ?>" target="<?php echo esc_attr( $s_target ); ?>">
            <?php echo esc_html( $s_title ); ?>
        </a>

    <?php endif; ?>	

<?php endif; ?>

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
