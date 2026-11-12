<?php
// HTML5 Blank navigation
function html5blank_nav() {
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => '',
		'container_class' => 'menu-{menu slug}-container',
		'items_wrap'      => '<ul class="top-nav menu container">%3$s</ul>',
		'depth'           => 0,
		)
	);
}

// Remove the <div> surrounding the dynamic navigation
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}
add_filter('the_category', 'remove_category_rel_from_category_list');

// Add page slug to body class
function add_slug_to_body_class($classes) {
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) unset($classes[$key]);
    } elseif (is_page() || is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }
    return $classes;
}
add_filter('body_class', 'add_slug_to_body_class');

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'my_remove_recent_comments_style');

// Pagination for paged posts
function html5wp_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}
add_action('init', 'html5wp_pagination');

// Custom Excerpts Setup
function html5wp_index($length) { return 20; }
function html5wp_custom_post($length) { return 40; }

function html5wp_excerpt($length_callback = '', $more_callback = '') {
    global $post;
    if (function_exists($length_callback)) add_filter('excerpt_length', $length_callback);
    if (function_exists($more_callback)) add_filter('excerpt_more', $more_callback);
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    echo '<p>' . $output . '</p>';
}

function html5_blank_view_article($more) {
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}
add_filter('excerpt_more', 'html5_blank_view_article');

// Theme Cleanups & Filters
function remove_admin_bar() { return false; }
add_filter('show_admin_bar', 'remove_admin_bar');

function html5_style_remove($tag) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}
add_filter('style_loader_tag', 'html5_style_remove');

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);

function html5blankgravatar ($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}
add_filter('avatar_defaults', 'html5blankgravatar');

// Threaded Comments
function enable_threaded_comments() {
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}
add_action('get_header', 'enable_threaded_comments');

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth) {
    // (ใช้โค้ดเดิมจากในไฟล์ต้นฉบับได้เลยครับ เนื่องจากมีความยาวและเป็นโครงสร้าง HTML ส่วนใหญ่)
}

// -----------------------------------------------------------------------------
// Remove Unnecessary Head Tags
// -----------------------------------------------------------------------------
remove_action('wp_head', 'feed_links_extra', 3); 
remove_action('wp_head', 'feed_links', 2); 
remove_action('wp_head', 'rsd_link'); 
remove_action('wp_head', 'wlwmanifest_link'); 
remove_action('wp_head', 'index_rel_link'); 
remove_action('wp_head', 'parent_post_rel_link', 10, 0); 
remove_action('wp_head', 'start_post_rel_link', 10, 0); 
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); 
remove_action('wp_head', 'wp_generator'); 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Widget Text Filters
add_filter('widget_text', 'do_shortcode'); 
add_filter('widget_text', 'shortcode_unautop'); 
add_filter('the_excerpt', 'shortcode_unautop'); 
add_filter('the_excerpt', 'do_shortcode'); 
remove_filter('the_excerpt', 'wpautop');