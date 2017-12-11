<?php

/* Mandrill Key */
// $GLOBALS['mandrill_key']   = '';

/* Mailchimp Key */
$GLOBALS['mailchimp_key']  = 'bd397178d444851afaab1bc85144fc9d-us14';
$GLOBALS['mailchimp_list'] = 'bb33031de5';


/* States */

$projects = get_posts( array( 'post_type' => 'project', 'posts_per_page' => -1, 'order' => 'asc', 'orderby' => 'state', 'meta_key' => 'state' ) );
$states = array();

foreach ($projects as $project){
	  $state = get_post_meta($project->ID, "state", true);

	  if( !in_array($state, $states) ) {
	  	$states[] = $state;
	  }
	}


/* Cities */

$projects = get_posts( array( 'post_type' => 'project', 'posts_per_page' => -1, 'order' => 'asc', 'orderby' => 'city', 'meta_key' => 'city' ) );
$cities = array();

foreach ($projects as $project){
	  $city = get_post_meta($project->ID, "city", true);

	  if( !in_array($city, $cities) ) {
	  	$cities[] = $city;
	  }
	}

?>
