<?php

/**
 * Security Fixes for WordPress
 *
 */

/**
 *  Disallow file edit Insert this into your wp-config.php
 * define( 'DISALLOW_FILE_EDIT', true );
 * define( 'DISALLOW_FILE_MODS', true ); 
 */
/**
 * Disable Rest API
 */
// Filters for WP-API version 1.x
add_filter('json_enabled', '__return_false');
add_filter('json_jsonp_enabled', '__return_false');

add_filter('rest_authentication_errors', function ($result) {
    if (!empty($result)) {
        return $result;
    }
    //if (!is_user_logged_in()) {
    if (!is_user_logged_in()) {
        return new \WP_Error('restx_logged_out', 'Sorry, you must be logged in to make a request.', array('status' => 401));
    }
    return $result;
});

/**
 * Disable xmlrpc.php
 * # nginx block xmlrpc.php requests
 * location /xmlrpc.php {deny all;}
 * # Block WordPress xmlrpc.php requests
 *<Files xmlrpc.php>order allow,deny
 *deny from all</Files>
 */
add_filter('xmlrpc_enabled', '__return_false');
add_filter('xmlrpc_methods', 'custom_function_remove_xmlrpc_methods');
function custom_function_remove_xmlrpc_methods($methods)
{
    $methods = array(); //empty the array
    return $methods;
}

/**
 * Fallback for disabling the xmlrpc if .htaccess not working
 */
add_filter('wp_xmlrpc_server_class', 'disable_wp_xmlrpc');
function disable_wp_xmlrpc($data)
{
    http_response_code(403);
    exit('You dont have permission to access this file :)');

    return $data;
}
// Disable X-Pingback to header
add_filter('pings_open', '__return_false', PHP_INT_MAX);
add_filter('wp_headers', 'disable_x_pingback');
function disable_x_pingback($headers)
{
    unset($headers['X-Pingback']);

    return $headers;
}



/**
 * Remove Verion Number
 */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');
// add_filter('script_loader_src', 'remove_ver_param');
// add_filter('style_loader_src', 'remove_ver_param');
function remove_ver_param($url)
{
    return remove_query_arg('ver', $url);
}
/**
 * Remove Rss
 */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

add_action('do_feed', 'disable_feed', 1);
add_action('do_feed_rdf', 'disable_feed', 1);
add_action('do_feed_rss', 'disable_feed', 1);
add_action('do_feed_rss2', 'disable_feed', 1);
add_action('do_feed_atom', 'disable_feed', 1);
add_action('do_feed_rss2_comments', 'disable_feed', 1);
add_action('do_feed_atom_comments', 'disable_feed', 1);

/**
 * Speed Up wordprees
 * remove emoji
 */

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

/* remove wlw from manifest */
remove_action('wp_head', 'wlwmanifest_link');

/**Disable File editing */
define('DISALLOW_FILE_EDIT', true);
// define('DISALLOW_FILE_MODS', true);

/**Disable PHP file execution */
/* <Files *.php>
 Order Allow,Deny
 Deny from all
</Files> */

//add_filter( 'wp_is_application_passwords_available', '__return_true' );


// Alternative
// Fully Disable Gutenberg editor.
//add_filter('use_block_editor_for_post_type', '__return_false', 10);
// Don't load Gutenberg-related stylesheets.
//add_action( 'wp_enqueue_scripts', 'hdl_remove_block_css', 100 );
function hdl_remove_block_css() {
wp_dequeue_style( 'wp-block-library' ); // Wordpress core
wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
wp_dequeue_style( 'wc-block-style' ); // WooCommerce
wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme

}
//remove_action( 'wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles' );


// acf required

add_action('after_switch_theme', 'mytheme_set_acf_notice_flag');
function mytheme_set_acf_notice_flag() {
    set_transient('mytheme_show_acf_notice', true, 30);
}

add_action('admin_notices', 'mytheme_acf_required_notice_once');
function mytheme_acf_required_notice_once() {
    //if (get_transient('mytheme_show_acf_notice')) {
        delete_transient('mytheme_show_acf_notice');
        if (!is_plugin_active('advanced-custom-fields-pro/acf.php')) {
            echo '<div class="notice notice-error is-dismissible"><p><strong>Important:</strong> This theme requires the <a href="https://wordpress.org/plugins/advanced-custom-fields/" target="_blank">Advanced Custom Fields</a> plugin. Please install and activate it.</p></div>';
        }
   // }
}

/** show the acf required messge */
add_action('template_redirect', 'mytheme_check_acf_frontend');
function mytheme_check_acf_frontend() {
    if (!is_admin() && !function_exists('get_field')) {
        add_action('wp_head', 'mytheme_hide_theme_output', 0);
        add_action('wp_footer', 'mytheme_show_acf_required_message', 1000);
    }
}

function mytheme_hide_theme_output() {
    ob_start(); // Start output buffering to suppress content
    add_filter('the_content', '__return_empty_string', PHP_INT_MAX); // Blank post content
}

function mytheme_show_acf_required_message() {
    ob_end_clean(); // Clear anything that might have been output
    wp_die(
        '<h1>Theme Content Unavailable</h1><p>This theme requires the <strong>Advanced Custom Fields</strong> plugin to display content.</p><p>Please install and activate <a href="https://wordpress.org/plugins/advanced-custom-fields/" target="_blank">ACF</a>.</p>',
        'ACF Required',
        array('response' => 200)
    );
}



/*@ Change WordPress Admin Login Logo Link URL  */
if ( !function_exists('hdl_wp_admin_login_logo_url') ) :
 
    function hdl_wp_admin_login_logo_url() {
        return home_url();
    }
    add_filter( 'login_headerurl', 'hdl_wp_admin_login_logo_url' );
 
endif;

/*@ Change WordPress Admin Login Logo */
if (!function_exists('hdl_wp_admin_login_logo') && function_exists('get_field')) :

    function hdl_wp_admin_login_logo()
    { 
        $header_logo = get_field('logo', 'option');
        $logo = wp_get_attachment_url($header_logo);
        ?>
        <style type="text/css">
            body.login div#login h1 a {               
                background-image: none, url(<?php echo $logo;; ?>);
                background-size: 130px;
                background-position: center center;
                background-repeat: no-repeat;
                background-color: #1c1438;
                width: 100%;
            }
        </style>
<?php }

    add_action('login_enqueue_scripts', 'hdl_wp_admin_login_logo');

endif;
/*@ Change WordPress Admin Login Logo's Title  */
if ( !function_exists('hdl_wp_admin_login_logo_title') ) :
 
    function hdl_wp_admin_login_logo_title( $headertext ) {
        $headertext = esc_html__( get_bloginfo('name'), 'keplercloud' );
        return $headertext;
    }
    add_filter( 'login_headertext', 'hdl_wp_admin_login_logo_title' );
 
endif;