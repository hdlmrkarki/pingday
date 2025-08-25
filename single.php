<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hdltheme
 */

get_header(); ?>

<section class="custom-breadcrumb ">
	<div class="container-fluid container-fluid-custom">
		<div class="row">
			<div class="col-lg-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Hem</a>
						</li>
						<li class="breadcrumb-item"><a href="#">Nyheter/blogg lorem ipsum</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Hållbar och säker hamn med IoT</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="pt-110 pb-30">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<div class="text-container text-center text-md-left">
					<h1><?php the_title(); ?></h1>
					<div class="date d-none d-md-block">
						<?php
						echo _e('Published ', 'hdltheme') . get_the_date('j m Y');
						?>
						<!-- Publicerad 01 01 2026 -->
					</div>
				</div>
				<div class="featured-img-and-quote-block mt-30 mb-35">
					<?php
					$image = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'w-100'));
					echo preg_replace('/(width|height)="\d*"\s/', '', $image);
					?>
				</div>

				<div class="date d-block d-md-none extra-pd-sm">
					<!-- Publicerad 01 01 2026 -->
					<?php
					echo _e('Published ', 'hdltheme') . get_the_date('j m Y');
					?>
				</div>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>
<?php
global $post;
// Get categories of current post
$categories = wp_get_post_terms($post->ID, 'category', array('fields' => 'ids'));
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 10,
	'post__not_in' => array($post->ID), // Exclude current post
	'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => $categories,
		)
	)
);
$related_query = new WP_Query($args);
if ($related_query->have_posts()):
?>
	<section class="pt-80 pb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title text-color-orange mb-35">
						<h2><?php echo get_field('news_related_title', 'option'); ?></h2>
					</div>

					<div class="blog-slider-block extra-pd-sm">
						<div class="blog-slider">
							<?php $i = 0;
							while ($related_query->have_posts()): $related_query->the_post();
								get_template_part('template-parts/content', 'post-slider');
								$i++;
							endwhile;
							wp_reset_postdata(); ?>


						</div>

						<div class="btn-arrow-wrapper text-center mt-60">
							<?php if ($i > 3): ?>
								<div class="round-btn left-arrow"><span class="icon-left-arrow"></span></div>
							<?php endif; ?>
							<?php
							$link = get_field('news_related_more_link', 'option');
							if ($link):
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
							?>
								<!-- <div class="btn-wrapper mt-30"> -->
								<a class="theme-btn has-no-round-icon m-0" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
								<!-- </div> -->
							<?php endif; ?>
							<!-- <a href="#" class="theme-btn has-no-round-icon m-0">Se alla nyheter</a> -->
							<?php if ($i > 3): ?>
								<div class="round-btn right-arrow"><span class="icon-right-arrow"></span></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php get_footer();
