<?php
/*
 *  Custom functions, support, custom post types and more.
 */

// ป้องกันการเข้าถึงไฟล์โดยตรง
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_includes = array(
	'/inc/setup.php',              // ตั้งค่าพื้นฐาน (Theme supports, Menus)
	// '/inc/custom-post-types.php',  // ลงทะเบียน Custom Post Types และ Taxonomies
    '/inc/enqueue.php',            // โหลดไฟล์ CSS และ JS ของธีม
    '/inc/hooks.php',              // รวม Actions, Filters และ Core Functions 
	'/inc/shortcodes.php',         // รวม Shortcodes ทั้งหมดของธีม
);

// วนลูปเพื่อดึงไฟล์เข้าสู่ระบบ
foreach ( $theme_includes as $file ) {
	$filepath = get_template_directory() . $file;
	
	if ( file_exists( $filepath ) ) {
		require_once $filepath;
	} else {
		error_log( sprintf( 'Theme Error: ไม่พบไฟล์ %s สำหรับดึงเข้าสู่ระบบ', $file ) );
	}
}