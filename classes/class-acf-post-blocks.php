<?php 

class Hdltheme_ACF_POST_Blocks {
   private $blocks = [];

   public function __construct($blocks) {
      $this->blocks = $blocks;

      add_filter('block_categories_all', [$this, 'register_layout_category'], 1);

      add_action('acf/init', [$this, 'register_blocks']);
      add_filter('allowed_block_types_all', [$this, 'restrict_gutenberg_blocks'], 10, 2);

      add_action('enqueue_block_editor_assets', [$this, 'enqueue_editor_assets']);
   }

   public function register_layout_category($categories)
   {
      $custom_category = [
         'slug'  => 'hdltheme-post',
         'title' => 'Pingday Posts'
      ];

      array_unshift($categories, $custom_category);
   
      return $categories;
   }

   public function register_blocks() {
      if (!function_exists('acf_register_block_type')) {
         return;
      }

      foreach ($this->blocks as $block) {
         $category = @$block['category']?:'hdltheme-post';

         $preview_image = get_template_directory_uri() . "/blocks-post/images/{$block['name']}.png"; // Adjust path as needed

         acf_register_block_type([
            'name'              => $block['name'],
            'title'             => __($block['title']),
            'description'       => __($block['description']),
            'render_template'   => "/blocks-post/{$block['name']}.php",
            'mode'              => 'code',
            'category'          => $category,
            'icon'              => $block['icon'],
            'keywords'          => $block['keywords'],
            'example'           => [
               'attributes' => [
                  'mode' => 'preview',
                  'data' => [
                     'preview_image' => $preview_image
                  ]
               ]
            ]
         ]);
      }
   }

   // Enqueue styles and scripts for the block editor (Gutenberg)
   public function enqueue_editor_assets() {
      // Only load these files in the block editor
      wp_enqueue_style(
         'hdltheme-block-editor-styles',
         get_template_directory_uri() . '/assets/css/main.min.css',
         [],
         filemtime(get_template_directory() . '/assets/css/main.min.css') // Use versioning to avoid cache
      );

      // IF ENABLED THEN CONFLICT WITH ACF JS
      // wp_enqueue_script(
      //    'hdltheme-block-editor-scripts',
      //    get_template_directory_uri() . '/assets/js/app.min.js',
      //    [],
      //    filemtime(get_template_directory() . '/assets/js/app.min.js'),
      //    true
      // );
   }

   public function restrict_gutenberg_blocks($allowed_block_types, $post) {
      // if ( 'page' == $post->post->post_type || 'products' == $post->post->post_type ) {
      if ( 'post' == $post->post->post_type ) {
         // Preserve previously allowed blocks if they exist
         if (!is_array($allowed_block_types)) {
            //$allowed_block_types = [];
         }

         foreach ($this->blocks as $block) {
            $allowed_block_types= 'acf/' . $block['name'];
         }

         return $allowed_block_types;
      }

      return $allowed_block_types;

   }
}

new Hdltheme_ACF_POST_Blocks( [
   [
      'name'        => 'two-column-conent',
      'title'       => 'Two Column Content(Post)',
      'description' => 'A content box with column layout',
      'icon'        => 'editor',
      'keywords'    => ['hdltheme-post', 'pingday','column','content'],
   ],
   [
      'name'        => 'two-column-image-content',
      'title'       => 'Image Content Column(Post)',
      'description' => 'A image content box with column layout',
      'icon'        => 'format-image',
      'keywords'    => ['hdltheme-post', 'pingday','column','content','image'],
   ],
   [
      'name'        => 'profile-block',
      'title'       => 'Profile Block(Post)',
      'description' => 'A block with image and info',
      'icon'        => 'format-image',
      'keywords'    => ['hdltheme-post', 'pingday','profile'],
   ],
   [
      'name'        => 'media-block-post',
      'title'       => 'Media Block(Post)',
      'description' => 'A image/video block',
      'icon'        => 'video',
      'keywords'    => ['hdltheme-post', 'pingday','video','image'],
   ],
   [
      'name'        => 'quote-block',
      'title'       => 'Quote Block(Post)',
      'description' => 'Quote Block',
      'icon'        => 'video',
      'keywords'    => ['hdltheme-post', 'pingday','quote','image'],
   ]
] );  