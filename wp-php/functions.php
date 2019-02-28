<?php
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; 

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/style.css',array( $parent_style ),wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function custom_script() {
    wp_enqueue_style( 'style-name', get_stylesheet_uri() );
    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/display_image.js',NULL,1.0, true);
    wp_localize_script('script-name','megadata',array(
     'nonce' => wp_create_nonce(wp_rest),
     'siteURL'=>get_site_url()
    ));
}
add_action( 'wp_enqueue_scripts', 'custom_script' );

global $wpdb;
$results = $wpdb->get_results( 'SELECT * FROM wp_posts WHERE id = 1', OBJECT );
var_dump($results);
