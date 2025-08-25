<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hdltheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap"
		rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<?php
	$header_logo = get_field('logo', 'option');

	$header_class = get_field('light_header') ? 'light-header' : 'dark-heder';
	$thumbnail_image = get_field('header_decoration_image') ? get_field('header_decoration_image') : ASSETS_URL . 'page-bg2.svg';
	if (!get_field('hide_decoration_image')):
	?>
		<div class="page-bg-img">
			<img src="<?php echo $thumbnail_image; ?>" alt="header-decoration-image">
		</div>
	<?php endif; ?>

	<header class="main-header <?php echo $header_class; ?>">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col col-main-menu">
					<nav class="navbar navbar-expand-xl main-nav">
						<div class="collapse navbar-collapse" id="navbar">
							<div class="menu-content">
								<div class="menu-wrapper">
									<?php
									wp_nav_menu(
										array(
											'container' => false,
											'theme_location' => 'menu-1',
											'menu_id'        => 'menu-left',
											'menu_class'     => 'nav navbar-nav',
											'walker' => new WP_Bootstrap_Navwalker()
										)
									);
									?>
								</div>
							</div>
							<?php $footer_social_title = get_field('footer_social_title', 'option'); ?>
							<div class="menu-social d-block d-xl-none mt-60">
								<?php if ($footer_social_title): ?>
									<p><strong><?php echo $footer_social_title; ?></strong></p>
								<?php endif; ?>

								<?php if (have_rows('social_links', 'option')): ?>
									<ul>
										<?php while (have_rows('social_links', 'option')): the_row(); ?>
											<li>
												<a href="<?php echo get_sub_field('link'); ?>" target="_blank">
													<span class="icon-<?php echo get_sub_field('logo'); ?>"></span>
												</a>
											</li>
										<?php endwhile; ?>
									</ul>
								<?php endif; ?>
							</div>							
						</div>
					</nav>
				</div>
				<div class="col col-logo">
					<div class="logo-block">
						<div class="brandLogo">
							<!-- Brand -->
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<?php if ($header_logo):
									echo __get_custom_image($header_logo, 'large');
								?>
								<?php else: echo get_bloginfo('name');
								endif; ?>
							</a>
						</div>
					</div>
				</div>
				<div class="col col-right-block">
					<div class="right-header">
						<nav class="navbar navbar-expand-xl main-nav">
							<div class="d-flex">
								<div class="menu-content">
									<div class="menu-wrapper">
										<?php
										wp_nav_menu(
											array(
												'container' => false,
												'theme_location' => 'menu-2',
												'menu_id'        => 'menu-right',
												'menu_class'     => 'nav navbar-nav',
												'walker' => new WP_Bootstrap_Navwalker()
											)
										);
										?>
									</div>

								</div>
							</div>
						</nav>
					</div>
				</div>

				<div class="col col-hamburger d-block d-xl-none">
					<div class="toggle-wrapper">
						<div class="navbar-toggler navbar-toggle-btn nav-open">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<main>