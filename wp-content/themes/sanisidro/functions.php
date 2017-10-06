<?php
// Load stylesheet for San Isidro Theme.
function learningWordpress_resources() {

	wp_enqueue_style( 'style', get_stylesheet_uri() );

}

add_action('wp_enqueue_scripts','learningWordpress_resources');

// // Enqueue Slick scripts and styles
function themeprefix_slick_enqueue_scripts_styles() {

	 wp_enqueue_script( 'sanisidro', get_template_directory_uri() . '/src/js/sanisidro.js', array( 'jquery' ),true);
	 wp_enqueue_script( 'slickjs', get_stylesheet_directory_uri() . '/src/js/vendors/slick.min.js', array( 'jquery' ), '1.6.0', true );
   wp_enqueue_script( 'jquery.lazyload.js', get_stylesheet_directory_uri() . '/src/js/vendors/jquery.lazyload.js', array( 'jquery' ), '1.9.3', true );
	 wp_enqueue_script( 'slickjs-init', get_stylesheet_directory_uri(). '/src/js/slick-init.js', array( 'slickjs' ), '1.6.0', true );
	 wp_enqueue_style( 'slickcss', get_stylesheet_directory_uri() . '/src/css/slick.css', '1.6.0', 'all');
	 wp_enqueue_style( 'slickcsstheme', get_stylesheet_directory_uri(). '/src/css/slick-theme.css', '1.6.0', 'all');

}

add_action( 'wp_enqueue_scripts', 'themeprefix_slick_enqueue_scripts_styles' );

// Remove Admin bar
function remove_admin_bar(){
    return false;
}
add_filter( 'show_admin_bar', 'remove_admin_bar' ); // Remove Admin bar

add_image_size( 'full', '2400', '1200', false );

// Register San Isidro menus.
register_nav_menus( array(
		'primary' => __( 'Primary Menu'),
		'footer' => __( 'Footer Menu'),
	) );

// Register custom post Properties

add_action( 'init', 'create_post_type' );

function create_post_type() {

  register_post_type( 'project',
    array(
      'labels' => array(
        'name' => __( 'Projects' ),
        'singular_name' => __( 'Project' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'project'),
      'menu_position' => 5,
      'capability_type' => 'post'
    )
  );

  register_post_type( 'newsblog',
    array(
      'labels' => array(
        'name' => __( 'newsblogs' ),
        'singular_name' => __( 'newsblog' )
      ),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'news'),
      'menu_position' => 5
      // 'rewrite' => array( 'slug' => '/our-properties/%state%', 'with_front' => false )
    )
  );

 }

 function my_acf_load_field( $field ) {

    $field['choices'] = array(
        'custom' => 'My Custom Choice'
    );

    return $field;

}

add_filter('acf/load_field/type=select', 'my_acf_load_field');


function acf_load_state_field_choices( $field ) {

    // reset choices
    $field['choices'] = array();

    // get the textarea value from options page without any formatting
    $choices = get_field('state', 'project', false);

    // explode the value so that each line is a new array piece
    $choices = explode("\n", $choices);

    // remove any unwanted white space
    $choices = array_map('trim', $choices);

    // loop through array and add to field 'choices'
    if( is_array($choices) ) {

        foreach( $choices as $choice ) {

            $field['choices'][ $choice ] = $choice;

        }

    }

    // return the field
    return $field;

}

add_filter('acf/load_field/type=select', 'acf_load_state_field_choices');


flush_rewrite_rules();



