<?php
/**
* Template Name: Firm Page
*/

$post = Timber::get_post();
$data = Timber::context();
$data['post'] = $post;
Timber::render('page-firm.twig', $data);
