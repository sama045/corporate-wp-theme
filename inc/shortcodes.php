<?php
// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null) {
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; 
}
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo');

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) {
    return '<h2>' . $content . '</h2>';
}
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2');