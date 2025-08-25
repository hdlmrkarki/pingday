<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hdltheme
 */

get_header(); ?>
<section class="hero-block">

	<div class="hero-slider-wrapper">
		<div class="hero-slider inner-hero inner-small-hero position-relative">
			<div class="has-left-overlay"></div>
			<div class="single-slide">
				<div class="slider-bg">

					<img src="<?php echo get_field('banner_image') ? get_field('banner_image') : get_template_directory_uri() . '/assets/images/kundcase.png' ?>" alt="<?php echo get_the_title(); ?>" />
				</div>
				<div class="slider-content-wrapper h-100">
					<div class="container">
						<div class="row">
							<div class="col-xl-6 col-lg-8 col-md-10">
								<div class="slider-content">

									<div class="slider-text-content">
										<h1><?php _e('References', 'hdltheme') ?> - <?php echo get_field('tag_title'); ?></h1>
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
<section class="custom-breadcrumb ">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php if (function_exists('custom_breadcrumb')) {
					custom_breadcrumb();
				} ?>
			</div>
		</div>
	</div>
</section>
<section class="pt-140 pb-200 background-color-light-gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="white-box">
					<div class="white-box-conainer">
						<div class="top-block mb-35">
							<div class="block-title mb-35">
								<h2><?php the_title(); ?></h2>

							</div>
							<div class="featured-img mt-20 mb-20">
								<?php
								$image = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'w-100'));
								echo preg_replace('/(width|height)="\d*"\s/', '', $image);
								?>

							</div>

							<p class="preamble">
								<?php echo get_field('short_description'); ?>
							</p>
						</div>

						<div class="custom-text-container">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
global $post;
$args = array(
	'post_type' => 'referens',
	'posts_per_page' => 4,
	'post__not_in' => array($post->ID), // Exclude current post        
);
$related_query = new WP_Query($args);
if ($related_query->have_posts()):
?>
	<section class="pt-80 pb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="block-title mb-30">
						<h2><?php echo get_field('case_related_title', 'option'); ?></h2>
					</div>
					<div class="overflow-container-block img-text-block alt2">
						<?php while ($related_query->have_posts()): $related_query->the_post(); ?>
							<div class="single-block alt2 alt2-alt2 on-hover-scale  big-block">
								<a href="<?php echo get_the_permalink(); ?>" tabindex="0">
									<div class="img-container">
										<?php
										$image = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'w-100'));
										echo preg_replace('/(width|height)="\d*"\s/', '', $image);
										?>
									</div>
									<div class="text-container">
										<div class="icons-text-container">
											<div class="block-title">
												<div class="sub-title"><?php echo get_field('tag_title'); ?></div>
											</div>
											<h4><?php the_title() ?></h4>

											<p><?php echo wp_trim_words(get_field('short_description'), 18, '...'); ?></p>
										</div>

										<div class="btn-wrapper">
											<div class="round-btn"><span class="icon-arrow-right"></span></div>
										</div>
									</div>
									<div class="bottom-bullet">
										<img src="<?php echo ASSETS_URL; ?>bullet.svg" alt="bullet">
									</div>
								</a>
							</div>
						<?php endwhile;
						wp_reset_postdata(); ?>

					</div>
					<?php
					$link = get_field('case_related_more_link', 'option');
					if ($link):
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
					?>
						<div class="btn-wrapper mt-30">
							<a class="theme-btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
						</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php get_footer();
