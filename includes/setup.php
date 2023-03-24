<?php
function greek_newspapers_enqueue_scripts()
{
    // Enqueue Splide.js library
    wp_enqueue_style('splide', plugins_url() . '/greek-newspapers/includes/splide/splide.min.css');
    wp_enqueue_script('splide', plugins_url() . '/greek-newspapers/includes/splide/splide.min.js', array(), '3.0.13', true);

    // Enqueue custom script to initialize the slider
    wp_enqueue_script('my-slider-script', plugins_url('slider.js', __FILE__), array('splide'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'greek_newspapers_enqueue_scripts');
wp_enqueue_style('greek-newspapers-style', plugins_url('greek-newspapers.css', __FILE__));
