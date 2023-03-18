<?php
function enqueue_scripts() {
    // Enqueue Splide.js library
    wp_enqueue_style('splide', 'https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide.min.css');
    wp_enqueue_script('splide', 'https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/js/splide.min.js', array(), '3.0.13', true);

    // Enqueue custom script to initialize the slider
    wp_enqueue_script('my-slider-script', plugins_url('slider.js', __FILE__), array('splide'), '1.0.0', true);
 }
add_action('wp_enqueue_scripts', 'enqueue_scripts');
wp_enqueue_style('greek-newspapers-style', plugins_url('greek-newspapers.css', __FILE__));