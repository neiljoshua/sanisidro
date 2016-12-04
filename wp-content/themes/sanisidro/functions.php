<?php

// Load stylesheet for San Isidro Theme.
function learningWordpress_resources() {
	
	wp_enqueue_style( 'style', get_stylesheet_uri() );

}

add_action('wp_enqueue_scripts','learningWordpress_resources');

// Register San Isidro menus.
register_nav_menus( array(
		'primary' => __( 'Primary Menu'),
		'footer' => __( 'Footer Menu'),
	) );