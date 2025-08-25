<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package hdltheme
 */

get_header();
?>
<section class="hero-block">

	<div class="hero-slider-wrapper">
		<div class="hero-slider inner-hero inner-small-hero position-relative">
			<!-- <div class="has-left-overlay"></div> -->
			<div class="single-slide">
				<div class="slider-bg">
					<img src="images/search-result.png" alt="" />
				</div>
				<div class="slider-content-wrapper h-100">
					<div class="container">
						<div class="row">
							<div class="col-xl-6 col-lg-8 col-md-10">
								<div class="slider-content">

									<div class="slider-text-content">
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
<section class="pt-140 pb-140">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="search-result-block">
					<div class="block-title mb-20">
						<h1><?php _e('Search results:', 'hdltheme'); ?></h1>
					</div>
					<?php
					$results = ['post' => [], 'page' => [], 'referens' => []];

					if (have_posts()) {
						while (have_posts()) {
							the_post();
							$results[get_post_type()][] = get_the_ID();
						}
						foreach ($results as $type => $ids) {
							if (!empty($ids)):
					?>
								<div class="single-type">
									<?php if ($type == 'page'): ?>
										<h3><?php _e('Pages', 'hdltheme'); ?>:Sidor</h3>
									<?php elseif ($type == 'referens'): ?>
										<h3><?php _e('Referens', 'hdltheme'); ?>:Sidor</h3>
									<?php else: ?>
										<h3><?php _e('News', 'hdltheme'); ?>:Nyheter</h3>
									<?php endif; ?>
									<?php
									foreach ($ids as $id): ?>
										<div class="single-block br-8">
											<a href="<?php echo get_the_permalink($id); ?>">
												<div class="text-container">
													<h4>
														<?php if ($type == 'page'): ?>
															<?php _e('Page', 'hdltheme'); ?>:
														<?php endif; ?>
														<?php if ($type == 'referens'): ?>
															<?php _e('Referen', 'hdltheme'); ?>:
														<?php endif; ?>
														<?php echo get_the_title($id); ?>
													</h4>
													<p><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></p>
												</div>
												<div class="btn-wrapper mt-20">
													<div class="round-btn"><span class="icon-arrow-right"></span></div>
												</div>
											</a>
										</div>
									<?php endforeach;
									?>
								</div>
					<?php

							endif;
						}
					} else {
						_e('Enter one or more keywords in the search field', 'hdltheme');
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
