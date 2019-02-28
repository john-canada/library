<?php

function create_posttype() {
 
    register_post_type( 'movies',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Movies' ),
                'singular_name' => __( 'Movie' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'movies'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


//Displaying Custom Post Types on The Front Page
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'movies' ) );
    return $query;
}

//If you want to target the site front page specifically instead, you need to use is_front_page():
function wpse83754_filter_pre_get_posts( $query ) {
    if ( $query->is_main_query() && is_front_page() ) {
        $query->set( 'post_type', array( 'home_portfolio' ) );
    }
}
add_action( 'pre_get_posts', 'wpse83754_filter_pre_get_posts' );

// if you want to target a specific page, just call is_page( $id ):
function wpse83754_filter_pre_get_posts( $query ) {
    if ( $query->is_main_query() && is_page( $id ) ) {
        $query->set( 'post_type', array( 'home_portfolio' ) );
    }
}
add_action( 'pre_get_posts', 'wpse83754_filter_pre_get_posts' );