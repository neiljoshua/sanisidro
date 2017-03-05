<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name = "<?php bloginfo('name');?>" content = "<?php bloginfo('description')?>;">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
	</head>

<body <?php body_class(); 
	$body_class = body_class();
?>>
	<!-- Site container -->
	<div class="container">

		<a href="#" class="c-hamburger c-hamburger--rot"> <span>toggle menu</span> </a> 
			
		<!-- Site header -->
		<header class="site-header">

			<div class="site-branding">
				<a href="<?php echo home_url(); ?>"><img src="<?php echo site_icon_url();?>"/></a>
			</div>
			<!-- 	<h1> <?php //bloginfo('name');?></h1> -->
				
			<nav class="site-nav">

				<?php 
				$args =array(
					'theme_location'=> 'primary'
					);
				?>
				<?php wp_nav_menu($args); ?>
				
			</nav>

		</header> <!--site-geader-->
