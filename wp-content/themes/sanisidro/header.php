<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?>>
	<!-- Site container -->
	<div class="container">
		<!-- Site header -->
		<header class="site-header">

			<a href="#" class="c-hamburger c-hamburger--rot"> <span>toggle menu</span> </a> 
			
			<div class="site-branding">
				<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name');?></a></h1>
				<h6><?php bloginfo('description'); ?></h6>
			</div>
				
			<nav class="site-nav">

				<?php 
				$args =array(
					'theme_location'=> 'primary'
					);
				?>
				<?php wp_nav_menu($args); ?>
				
			</nav>

		</header> <!--site-geader-->
