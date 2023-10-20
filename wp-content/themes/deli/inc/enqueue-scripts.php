<?php

function enqueue_custom_admin_scripts() {
    wp_enqueue_script('custom-image-btn-js', get_stylesheet_directory_uri() . '/js/custom-image-btn.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('custom-remove-fields-js', get_stylesheet_directory_uri() . '/js/custom-remove-fields.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('custom-update-btn-js', get_stylesheet_directory_uri() . '/js/custom-update-btn.js', array('jquery'), '1.0.0', true);
    
    wp_enqueue_style('deli-product-data', get_stylesheet_directory_uri() . '/styles/product-data.css', array(), '1.0.0');
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_scripts');
