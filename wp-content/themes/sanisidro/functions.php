<?php
// Load stylesheet for San Isidro Theme.
function learningWordpress_resources() {
	
	wp_enqueue_style( 'style', get_stylesheet_uri() );

}

add_action('wp_enqueue_scripts','learningWordpress_resources');

// // Enqueue Slick scripts and styles
function themeprefix_slick_enqueue_scripts_styles() {

	 wp_enqueue_script( 'slickjs', get_stylesheet_directory_uri() . '/src/js/vendors/slick.min.js', array( 'jquery' ), '1.6.0', true );
	 wp_enqueue_script( 'slickjs-init', get_stylesheet_directory_uri(). '/src/js/slick-init.js', array( 'slickjs' ), '1.6.0', true );
	 wp_enqueue_style( 'slickcss', get_stylesheet_directory_uri() . '/src/css/slick.css', '1.6.0', 'all');
	 wp_enqueue_style( 'slickcsstheme', get_stylesheet_directory_uri(). '/src/css/slick-theme.css', '1.6.0', 'all');

}

add_action( 'wp_enqueue_scripts', 'themeprefix_slick_enqueue_scripts_styles' );


// Register San Isidro menus.
register_nav_menus( array(
		'primary' => __( 'Primary Menu'),
		'footer' => __( 'Footer Menu'),
	) );

