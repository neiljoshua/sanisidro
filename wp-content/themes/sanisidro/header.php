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
			
		<!-- Site header -->
		<header class="site-header">

			<a class="site-header__logo" href="<?php echo home_url(); ?>"><img src="<?php echo site_icon_url();?>"/></a>
			

			<a href="#" class="site-header__hamburger site-header__hamburger--rot"> <span></span> </a> 

			<div class="site-header__menu">

				<?php 
				$args =array(
					'theme_location'=> 'primary'
					);
				?>
				<?php wp_nav_menu($args); ?>
				
			</div>

		</header> <!--site-geader-->
		
		
		
