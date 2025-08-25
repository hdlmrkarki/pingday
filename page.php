<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hdltheme
 */

get_header();
?>
<?php if (!get_field('hide_breadcrumb')): ?>
    <?php if (!is_front_page()): ?>
        <section class="custom-breadcrumb ">
            <div class="container-fluid container-fluid-custom">
                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Hem</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Resurser</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Bredbandshandboken</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Hemmanätverk</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
<?php
while (have_posts()) :
    the_post();
    get_template_part('template-parts/content', 'page');
endwhile; // End of the loop.
// get_sidebar();
get_footer();
