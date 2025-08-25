<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hdltheme
 */

get_header();
?>
<section class="hero-block">

	<div class="hero-slider-wrapper">
		<div class="hero-slider home-hero hero-404 position-relative">
			<div class="has-left-overlay"></div>
			<div class="single-slide">
				<div class="slider-content-wrapper h-100">
					<div class="container">
						<div class="row">
							<div class="col-xl-6 col-lg-8 col-md-10 offset-xl-1">
								<div class="slider-content">

									<div class="slider-text-content has-block-bullet">
										<div class="block-bullet active">
											<img src="<?php echo ASSETS_URL; ?>bullet.svg" alt="bullet">
										</div>
										<div class="big-title">404</div>
										<h1><?php esc_html_e('Sidan kunde inte hittas', 'hdltheme'); ?></h1>
										<p><?php esc_html_e('Kunde inte hitta den sökta sidan. Det kan hända att den raderats eller att du angivit en felaktig we', 'hdltheme'); ?></p>


									</div>
									<div class="btn-wrapper mt-30">
										<a href="<?php echo home_url() ?>" class="theme-btn"><?php esc_html_e('Back to Home.', 'hdltheme'); ?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
