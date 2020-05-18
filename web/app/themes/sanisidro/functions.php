<?php

require_once(__DIR__ . '/vendor/autoload.php');

$timber = new \Timber\Timber();

if ( ! class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
    echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
  });

  add_filter('template_include', function( $template ) {
    return get_stylesheet_directory() . '/static/no-timber.html';
  });

  return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

function add_to_context( $data ) {
    $data['foo'] = 'bar';
    $data['stuff'] = 'I am a value set in your functions.php file';
    $data['notes'] = 'These values are available everytime you call Timber::get_context();';
    $data['menu'] = new TimberMenu('primary');
    $data['menu-footer'] = new TimberMenu('footer');
    return $data;
}
add_filter( 'timber_context', 'add_to_context' );


// Load stylesheet for San Isidro Theme.
function sanisidro_resources() {
	wp_enqueue_style( 'styles', get_template_directory_uri().'/dist/styles.css',null,false);
  wp_enqueue_script( 'build', get_template_directory_uri() . '/dist/build.js',null,false);
}

add_action('wp_enqueue_scripts','sanisidro_resources');

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

flush_rewrite_rules();
