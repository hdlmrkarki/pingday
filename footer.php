<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hdltheme
 */
?>
</main>
<?php
$footer_decoration_logo_1 = get_field('footer_decoration_logo_1', 'option');
$footer_decoration_logo_2 = get_field('footer_decoration_logo_2', 'option');
$footer_logo = get_field('footer_logo', 'option');
$footer_bottom_decoration_image = get_field('footer_bottom_decoration_image', 'option');
$footer_info = get_field('footer_info', 'option');
$footer_social_title = get_field('footer_social_title', 'option');
$copyright = get_field('copyright_text', 'option');
?>
<footer class="main-footer section-has-bg-img background-color-purple text-color-white section-has-border">
    <?php
    echo __get_custom_image($footer_decoration_logo_1, 'full', false, array('class' => 'bg-img d-none d-md-block'));
    echo __get_custom_image($footer_decoration_logo_2, 'full', false, array('class' => 'bg-img d-block d-md-none'));
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logo-block mb-30">
                    <div class="footer-logo extra-pd-sm">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                            echo __get_custom_image($footer_logo, 'large', false, array('class' => ''));
                            ?>
                        </a>
                    </div>
                </div>
                <div class="footer-main-content extra-pd-sm">
                    <div class="row">
                        <div class="col-xl-4 col-md-5 d-none d-md-block">
                            <div class="single-column">
                                <?php echo $footer_info; ?>
                            </div>
                        </div>

                        <div class="col-xl-8 col-md-7">
                            <div class="row row-gap-50">
                                <?php if (have_rows('footer_menu_1', 'option')): ?>
                                    <?php while (have_rows('footer_menu_1', 'option')): the_row(); ?>
                                        <div class="col-xl-3 col-md-6">
                                            <div class="single-column">
                                                <div class="single-block">
                                                    <?php if (get_sub_field('choose_menu')) {
                                                        wp_nav_menu(
                                                            array(
                                                                'container' => false,
                                                                'menu' => get_sub_field('choose_menu'),
                                                                'menu_id'        => '',
                                                                'menu_class'     => ''
                                                            )
                                                        );
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <?php if (have_rows('footer_menu_2', 'option')): ?>
                                    <?php while (have_rows('footer_menu_2', 'option')): the_row(); ?>
                                        <div class="col-xl-3 col-md-6">
                                            <div class="single-column">
                                                <div class="single-block">
                                                    <?php if (get_sub_field('choose_menu')) {
                                                        wp_nav_menu(
                                                            array(
                                                                'container' => false,
                                                                'menu' => get_sub_field('choose_menu'),
                                                                'menu_id'        => '',
                                                                'menu_class'     => ''
                                                            )
                                                        );
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>

                                <?php if (have_rows('footer_menu_3', 'option')): ?>
                                    <?php while (have_rows('footer_menu_3', 'option')): the_row(); ?>
                                        <div class="col-xl-3 col-md-6">
                                            <div class="single-column">
                                                <div class="single-block">
                                                    <?php if (get_sub_field('choose_menu')) {
                                                        wp_nav_menu(
                                                            array(
                                                                'container' => false,
                                                                'menu' => get_sub_field('choose_menu'),
                                                                'menu_id'        => '',
                                                                'menu_class'     => ''
                                                            )
                                                        );
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>

                                <div class="col-xl-3 col-md-6">
                                    <div class="single-column">
                                        <div class="single-block">
                                            <?php if (have_rows('footer_menu_4', 'option')): ?>
                                                <?php while (have_rows('footer_menu_4', 'option')): the_row(); ?>
                                                    <?php if (get_sub_field('choose_menu')) {
                                                        wp_nav_menu(
                                                            array(
                                                                'container' => false,
                                                                'menu' => get_sub_field('choose_menu'),
                                                                'menu_id'        => '',
                                                                'menu_class'     => ''
                                                            )
                                                        );
                                                    } ?>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            <br />
                                            <?php if ($footer_social_title): ?>
                                                <p><strong><?php echo $footer_social_title; ?></strong></p>
                                            <?php endif; ?>

                                            <?php if (have_rows('social_links', 'option')): ?>
                                                <ul class="socials">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($footer_bottom_decoration_image): ?>
                    <div class="footer-img-block extra-pd-sm">
                        <?php
                        echo __get_custom_image($footer_bottom_decoration_image, 'full', false, array('class' => 'w-100'));
                        ?>
                    </div>
                <?php endif; ?>

                <?php if ($copyright): ?>
                    <div class="footer-bottom-text text-center text-color-orange mt-25 font-16 extra-pd-sm">

                        <?php
                        //$content = get_field('your_acf_field_name'); // Replace with your ACF field name
                        $current_year = date('Y');
                        $content = str_replace('{{Y}}', $current_year, $copyright);
                        $content = str_replace('{Y}', $current_year, $copyright);
                        ?>
                        <p><?php echo $content; ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
<?php if (have_rows('theme_faq', 'option')): ?>
    <?php while (have_rows('theme_faq', 'option')): the_row();
        if (get_sub_field('show_faq')):
    ?>
            <div class="fixed-faq-block">
                <div class="top-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="top-block-wrapper">
                                    <h4><?php echo get_sub_field('faq_opener_title'); ?></h4>
                                    <div class="icons-block">
                                        <span class="icon-arrow"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="main-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if (have_rows('add_faq', 'option')):
                                    while (have_rows('add_faq', 'option')): the_row(); ?>
                                        <div class="single-faq">
                                            <div class="question"><?php echo get_sub_field('title'); ?></div>
                                            <div class="answer custom-text-container">
                                                <?php echo get_sub_field('content'); ?>
                                            </div>
                                        </div>
                                <?php
                                    endwhile;
                                endif;

                                ?>
                                <div class="text-container custom-text-container mt-25">
                                    <?php echo get_sub_field('info'); ?>
                                </div>
                                <?php
                                $link = get_sub_field('button');
                                if ($link):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                ?><div class="btn-wrapper mt-25">
                                        <a class="theme-btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php endif;
    endwhile; ?>
<?php endif; ?>

<?php wp_footer(); ?>
</body>

</html>