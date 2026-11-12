<?php
if (!isset($content_width)) {
    $content_width = 900;
}

if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); 
    add_image_size('medium', 250, '', true); 
    add_image_size('small', 120, '', true); 
    add_image_size('custom-size', 700, 200, true); 

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

// Register HTML5 Blank Navigation
function register_html5_menu() {
    register_nav_menus(array( 
        'header-menu' => __('Header Menu', 'html5blank'), 
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), 
        'extra-menu' => __('Extra Menu', 'html5blank') 
    ));
}
add_action('init', 'register_html5_menu');

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}