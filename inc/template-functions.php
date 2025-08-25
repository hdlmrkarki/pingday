<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package hdltheme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hdltheme_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (! is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (! is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'hdltheme_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function hdltheme_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
    if (!function_exists('get_field')) {
        echo '<div style="padding: 20px; text-align:center; background: #1c1f29; color: #fff; border: 1px solid #ffeeba;">
        <h2>ACF Plugin Missing</h2>
        <p>This site requires the <strong>Advanced Custom Fields</strong> plugin. Please install and activate it to continue.</p>
    </div>';
        exit;
    }
}
add_action('wp_head', 'hdltheme_pingback_header');


//Add support for webmp 
function convert_png_jpg_to_webp($file)
{

    $info = pathinfo($file['file']);
    $ext = strtolower($info['extension']);

    // Proceed only if it's a PNG or JPG file
    if (in_array($ext, ['png', 'jpg', 'jpeg'])) {
        $webp_file = $info['dirname'] . '/' . $info['filename'] . '.webp';

        // Convert using GD
        if ($ext == 'png') {
            $image = imagecreatefrompng($file['file']);
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        } else {
            $image = imagecreatefromjpeg($file['file']);
        }

        // Save as WebP
        if ($image) {
            imagewebp($image, $webp_file, 100); // Set quality to best
            imagedestroy($image);

            // Delete the original image
            if (file_exists($file['file'])) {
                unlink($file['file']);
            }

            $file['file'] = $webp_file;
            $file['url'] = str_replace('.' . $ext, '.webp', $file['url']);
            $file['type'] = 'image/webp';
        }
    }

    return $file;
}

add_filter('wp_handle_upload', 'convert_png_jpg_to_webp');

/* rewrite the png/jpg/jpeg to webp format */

function rewrite_image_urls_to_webp($content)
{

    return preg_replace('/\.(png|jpg|jpeg)/i', '.webp', $content);
}

add_filter('the_content', 'rewrite_image_urls_to_webp');


//add the breadcrumb support
function custom_breadcrumb()
{
    if (is_front_page()) return;

    global $post;
    echo '<nav aria-label="breadcrumb"><ol class="breadcrumb">';

    echo '<li class="breadcrumb-item"><a href="' . home_url() . '">Home</a></li>';

    if (is_singular()) {
        $post_type = get_post_type();

        // CPT archive link
        if ($post_type !== 'post' && $post_type !== 'page') {
            $post_type_obj = get_post_type_object($post_type);
            if ($post_type_obj && $post_type_obj->has_archive) {
                echo '<li class="breadcrumb-item"><a href="' . get_post_type_archive_link($post_type) . '">' . $post_type_obj->labels->singular_name . '</a></li>';
            }
        }

        // If hierarchical, show parent pages
        if (is_page() && $post->post_parent) {
            $parents = [];
            $parent_id = $post->post_parent;
            while ($parent_id) {
                $page = get_post($parent_id);
                $parents[] = '<li class="breadcrumb-item"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $parents = array_reverse($parents);
            foreach ($parents as $crumb) {
                echo ' &raquo; ' . $crumb;
            }
        }

        // For custom post types, show taxonomy terms if available
        $taxonomies = get_object_taxonomies($post_type);
        foreach ($taxonomies as $taxonomy) {
            if ($taxonomy === 'post_format') continue; // skip post formats
            $terms = get_the_terms($post->ID, $taxonomy);
            if ($terms && !is_wp_error($terms)) {
                $term = current($terms);
                $term_link = get_term_link($term);
                if (!is_wp_error($term_link)) {
                    echo ' <li class="breadcrumb-item"><a href="' . esc_url($term_link) . '">' . esc_html($term->name) . '</a></li>';
                }
            }
        }

        echo ' <li class="breadcrumb-item"><span>' . get_the_title() . '</span></div>';
    } elseif (is_archive()) {
        if (is_post_type_archive()) {
            echo ' &raquo; ' . post_type_archive_title('', false);
        } elseif (is_tax() || is_category() || is_tag()) {
            $term = get_queried_object();
            echo ' &raquo; ' . esc_html($term->name);
        }
    } elseif (is_search()) {
        echo ' &raquo; Search results for "' . get_search_query() . '"';
    } elseif (is_404()) {
        echo ' &raquo; Error 404';
    }

    echo '</ol></nav>';
};

// pagination 
function get_custom_pagination($news)
{
    $big = 999999999; // need an unlikely integer

    $pagination_link = paginate_links(array(
        'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'  => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total'   => $news->max_num_pages,
        'type'    => 'array',
        'prev_text' => '<',
        'next_text' => '>',
    ));
    return $pagination_link;
}

//custom image function 
function __get_custom_image($attachment_id, $size = 'full', $icon = false, $attr = '') {
    $image_html = wp_get_attachment_image($attachment_id, $size, $icon, $attr);

    // Remove width and height attributes
    $image_html = preg_replace('/(width|height)="\d*"\s*/i', '', $image_html);

    return $image_html;
}


