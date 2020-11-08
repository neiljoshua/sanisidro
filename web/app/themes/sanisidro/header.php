<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <title><?php bloginfo('name'); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name = "Description" content = "<?php bloginfo('description')?>;">
    <meta name = "<?php bloginfo('name');?>" content = "<?php bloginfo('description')?>;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=0">
    <meta title="<?php bloginfo('name'); ?>">
    <?php wp_head(); ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-82838385-4"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-82838385-4');
    </script>
  </head>
  <body
    <?php body_class();
      $body_class = body_class();
    ?>>
    <div class="container">
      <header class="site-header">
        <a class="site-header__logo" href="<?php echo home_url(); ?>"><img src="<?php echo site_icon_url();?>" alt= "Logo"/></a>
        <a href="#" class="site-header__hamburger site-header__hamburger--rot"> <span></span></a>

        <div class="site-header__menu">
          <?php
            $args =array(
              'theme_location'=> 'primary'
              );
          ?>
          <?php wp_nav_menu($args); ?>
        </div>
      </header>



