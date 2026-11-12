<?php 
function enqueue_typer_scripts() {
    // โหลดไลบรารี Typed.js จาก CDN (โหลดไว้ที่ Footer)
    wp_enqueue_script( 
        'typed-js', 
        'https://cdn.jsdelivr.net/npm/typed.js@2.0.12/lib/typed.min.js', 
        array(), 
        '2.0.12', 
        true 
    );

    // โหลดไฟล์ JS ของธีมคุณ (สมมติว่าชื่อ main.js และต้องใช้ jQuery)
    wp_enqueue_script( 
        'fullscreen-main-js', 
        get_template_directory_uri() . '/js/main.js', 
        array('jquery', 'typed-js'), // บังคับว่าต้องโหลด jQuery และ Typed.js ก่อน
        '1.0.0', 
        true 
    );
}
add_action( 'wp_enqueue_scripts', 'enqueue_typer_scripts' );

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts() {
    // โหลด Scripts สำหรับ Header 
}
add_action('init', 'html5blank_header_scripts'); 

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts() {
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); 
        wp_enqueue_script('scriptname'); 
    }
}
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); 

// Load HTML5 Blank styles
function html5blank_styles() {
    wp_register_style('html5blank', get_template_directory_uri() . '/css/style.css', array(), '1.1', 'all');
    wp_enqueue_style('html5blank'); 
}
add_action('wp_enqueue_scripts', 'html5blank_styles');
?>