<?php
add_filter('wp_get_attachment_image_attributes', 'remove_img_size_attrs', 999, 3);

function remove_img_size_attrs($attr, $attachment, $size)
{
   unset($attr['width'], $attr['height']);
   return $attr;
}





class Hdltheme_Theme_Setting
{
   public function __construct()
   {
      add_action('init', [$this, 'theme_setting_option_page']);
      add_filter('upload_mimes', [$this, 'allow_cc_mime_types']);

      add_filter('acf/load_field/name=content_bg_color', [$this, 'hdl_acf_content_bg_color']);
      add_filter('acf/load_field/name=btn_color', [$this, 'hdl_acf_content_bg_color']);
      add_filter('acf/load_field/name=content_text_color', [$this, 'hdl_acf_content_text_color']);
      add_filter('acf/load_field/name=post_category', [$this, 'hdl_acf_post_category_choices']);
      add_filter('acf/load_field/key=field_6826dcfe0d441', [$this, 'hdl_acf_load_menu_choices']);
      add_filter('acf/load_field/key=field_6826dce80d43e', [$this, 'hdl_acf_load_menu_choices']);
      add_filter('acf/load_field/key=field_6826dd0b0d444', [$this, 'hdl_acf_load_menu_choices']);
      add_filter('acf/load_field/key=field_6853e396e1cf7', [$this, 'hdl_acf_load_menu_choices']);

      add_filter('wp_check_filetype_and_ext', [$this, 'bypass_svg_check'], 10, 4);
      add_filter('acf/load_field/name=select_form', [$this, 'populate_gravity_forms']);


      // add_action( 'wp_footer', [ $this, 'popup_modal' ] );
   }

   /*
   * Create theme setting option using ACF built in function
   */
   public function theme_setting_option_page()
   {
      if (function_exists('acf_add_options_page')) {
         acf_add_options_page(array(
            'page_title'    => 'Theme General Settings',
            'menu_title'    => 'Theme Settings',
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
         ));
         acf_add_options_sub_page(array(
            'page_title'    => 'Theme Header Settings',
            'menu_title'    => 'Header',
            'parent_slug'   => 'theme-general-settings',
         ));

         acf_add_options_sub_page(array(
            'page_title'    => 'Theme Footer Settings',
            'menu_title'    => 'Footer',
            'parent_slug'   => 'theme-general-settings',
         ));
      }
      register_post_type('referens', array(
         'public' => true,
         'show_in_rest' => false,
         'publicly_queryable' => true,
         'has_archive' => true, // ✅ Enables archive page

         'menu_icon' => 'dashicons-editor-kitchensink',
         'supports' => array('title', 'custom-fields', 'editor', 'thumbnail'),
         'labels' => array(
            'name'          => esc_html__('Referens', 'textdomain'),
            'singular_name' => esc_html__('Referens', 'textdomain')
         ),
      ));

      // register_taxonomy('product_cat', 'product', array(
      //    'labels'                => __('Category', 'textdomain'),
      //    'rewrite'      => array('slug' => 'product-category'),
      //    'show_admin_column'     => true,
      //    'show_ui'               => true,
      //    'hierarchical' => true,
      // ));
      add_filter('acf/load_field/name=menu_select', 'populate_menu_select_field');
   }

   public function allow_cc_mime_types($mimes)
   {
      $mimes['svg'] = 'image/svg+xml';
      return $mimes;
   }
   // Fix for SVG file display in Media Library
   public function bypass_svg_check($data, $file, $filename, $mimes)
   {
      $ext = pathinfo($filename, PATHINFO_EXTENSION);

      if (strtolower($ext) === 'svg') {
         $data['ext']  = 'svg';
         $data['type'] = 'image/svg+xml';
      }

      return $data;
   }

   /*
   * Dynamically add the category in the acf field backend
   * @params $field 
   */
   public function hdl_acf_post_category_choices($field)
   {
      // Reset choices
      $field['choices'] = array();

      // Get all menus
      $categories = get_terms([
         'taxonomy' => 'category',
         'hide_empty' => false, // Set to true to hide empty categories
      ]);


      if (! empty($categories)) {
         foreach ($categories as $category) {
            $field['choices'][$category->term_id] = $category->name;
         }
      }

      return $field;
   }

   /*
   * Dynamically add the menus in the acf field backend
   * @params $field 
   */
   public function hdl_acf_load_menu_choices($field)
   {
      // Reset choices
      $field['choices'] = array();

      // Get all menus
      $menus = wp_get_nav_menus();
      //error_log(print_r($menus, true));

      if (! empty($menus)) {
         foreach ($menus as $menu) {
            $field['choices'][$menu->term_id] = $menu->name;
         }
      }

      return $field;
   }
   public function hdl_acf_content_bg_color($field)
   {
      // Reset choices
      $field['choices'] = array();

      // Get all menus
      $colors = get_field('add_bg_color','option');
      //error_log(print_r($menus, true));
      // print_r($colors);
      // exit;
      if (! empty($colors)) {
         foreach ($colors as $color) {
            $field['choices'][$color['color_name']] = $color['color_name'];
         }
      }

      return $field;
   }
   public function hdl_acf_content_text_color($field)
   {
      // Reset choices
      $field['choices'] = array();

      // Get all menus
      $colors = get_field('add_text_color','option');
      //error_log(print_r($menus, true));

      if (! empty($colors)) {
         foreach ($colors as $color) {
            $field['choices'][$color['color_name']] = $color['color_name'];
         }
      }

      return $field;
   }

   public function populate_gravity_forms($field)
   {
      // Reset choices
      $field['choices'] = [];

      if (class_exists('GFAPI')) {
         $forms = GFAPI::get_forms();

         foreach ($forms as $form) {
            $field['choices'][$form['id']] = $form['title'];
         }
      }

      return $field;
   }

   public function popup_modal()
   {

      $setting = get_field('popup_container', 'option');

      if ($setting['enable'] == true):

         ob_start();
?>
         <div class="modal-opener" data-toggle="modal" data-target="#exampleModal">
            <span class="icon-chat"></span>
         </div>

         <!-- Modal -->
         <div class="modal form-modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="modal-body">
                     <div class="headings-block">
                        <h3 class="title-modal mb-10"><?php echo esc_html($setting['heading']); ?></h3>
                        <div type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
                           <span class="icon-close"></span>
                        </div>
                     </div>
                     <?php echo wpautop($setting['content']); ?>

                     <?php echo do_shortcode($setting['gravity_form_shortcode']); ?>
                  </div>
               </div>
            </div>
         </div>
<?php
         echo ob_get_clean();
      endif;
   }
}

new Hdltheme_Theme_Setting();
