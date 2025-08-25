<?php 

class Hdltheme_ACF_Blocks {
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
         'slug'  => 'hdltheme',
         'title' => 'Pingday Pages'
      ];

      array_unshift($categories, $custom_category);
   
      return $categories;
   }

   public function register_blocks() {
      if (!function_exists('acf_register_block_type')) {
         return;
      }

      foreach ($this->blocks as $block) {
         $category = @$block['category']?:'hdltheme';

         $preview_image = get_template_directory_uri() . "/blocks/images/{$block['name']}.png"; // Adjust path as needed

         acf_register_block_type([
            'name'              => $block['name'],
            'title'             => __($block['title']),
            'description'       => __($block['description']),
            'render_template'   => "/blocks/{$block['name']}.php",
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
         get_template_directory_uri() . '/assets/css/admin.min.css',
         [],
         filemtime(get_template_directory() . '/assets/css/admin.min.css') // Use versioning to avoid cache
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
      if ( 'page' == $post->post->post_type ) {
         // Preserve previously allowed blocks if they exist
         if (!is_array($allowed_block_types)) {
            //$allowed_block_types = [];
         }

         foreach ($this->blocks as $block) {
            $allowed_block_types = 'acf/' . $block['name'];
         }

         return $allowed_block_types;
      }

      return $allowed_block_types;

   }
}

new Hdltheme_ACF_Blocks( [
   
   [
      'name'        => 'hero-banner',
      'title'       => 'Hero Banner',
      'description' => 'A hero banner.',
      'icon'        => 'format-image',
      'keywords'    => ['hdltheme','pingday', 'hero-banner'],
   ],
   [
      'name'        => 'icon-link',
      'title'       => 'Icon Link',
      'description' => 'A icon list block with link',
      'icon'        => 'editor-unlink',
      'keywords'    => ['hdltheme','pingday', 'icon','link'],
   ],
   [
      'name'        => 'scroll-bar',
      'title'       => 'Scoll Bar',
      'description' => 'Create scrollbar with image',
      'icon'        => 'image-flip-horizontal',
      'keywords'    => ['hdltheme','pingday', 'scroll','image'],
   ],
   [
      'name'        => 'two-col-img-text',
      'title'       => 'Two Column Image Text',
      'description' => 'Block with two column layout image and text',
      'icon'        => 'align-left',
      'keywords'    => ['hdltheme','pingday', 'two','column','image'],
   ],
   [
      'name'        => 'speech-bubble',
      'title'       => 'Speech Bubble',
      'description' => 'Speech text in the bubble from',
      'icon'        => 'format-chat',
      'keywords'    => ['hdltheme','pingday', 'speech','bubble','text'],
   ],
   [
      'name'        => 'cta-block',
      'title'       => 'CTA Block',
      'description' => 'Section with content and link',
      'icon'        => 'editor-spellcheck',
      'keywords'    => ['hdltheme','pingday', 'cta','content','link'],
   ],
   [
      'name'        => 'contact-block',
      'title'       => 'Contact Block',
      'description' => 'Section with contact',
      'icon'        => 'forms',
      'keywords'    => ['hdltheme','pingday', 'contact','form'],
   ],
   [
      'name'        => 'image-block',
      'title'       => 'Image Block',
      'description' => 'Section with Image',
      'icon'        => 'format-image',
      'keywords'    => ['hdltheme','pingday', 'image','full'],
   ],
   [
      'name'        => 'tab-slider',
      'title'       => 'Tab Slider',
      'description' => 'Tab Section with slider design',
      'icon'        => 'table-col-before',
      'keywords'    => ['hdltheme','pingday', 'tab','slider'],
   ],
   [
      'name'        => 'number-block',
      'title'       => 'Number Block',
      'description' => 'Number block with text and color',
      'icon'        => 'analytics',
      'keywords'    => ['hdltheme','pingday', 'number','text'],
   ],
   [
      'name'        => 'grid-block',
      'title'       => 'Box(Grid) Block',
      'description' => 'Grid Box with link and color',
      'icon'        => 'analytics',
      'keywords'    => ['hdltheme','pingday', 'box','link','color'],
   ],
   [
      'name'        => 'media-block',
      'title'       => 'Media Block',
      'description' => 'Video/Image media block',
      'icon'        => 'analytics',
      'keywords'    => ['hdltheme','pingday', 'image','video'],
   ],
   [
      'name'        => 'simple-text-block',
      'title'       => 'Advanced Text Block',
      'description' => 'Avdance text block',
      'icon'        => 'analytics',
      'keywords'    => ['hdltheme','pingday', 'text','advanced'],
   ],
   [
      'name'        => 'steps-box-block',
      'title'       => 'Steps Box Block',
      'description' => 'Steps Box Block',
      'icon'        => 'analytics',
      'keywords'    => ['hdltheme','pingday', 'box','steps'],
   ],
   [
      'name'        => 'faq-block',
      'title'       => 'Faq Block',
      'description' => 'Frequently Asked Questions & Answers',
      'icon'        => 'analytics',
      'keywords'    => ['hdltheme','pingday', 'faq','questions','answer'],
   ],
   [
      'name'        => 'press-block',
      'title'       => 'Press Block',
      'description' => 'Press Block',
      'icon'        => 'analytics',
      'keywords'    => ['hdltheme','pingday', 'press'],
   ],
   [
      'name'        => 'blog-block',
      'title'       => 'Blog Block',
      'description' => 'Blog Block',
      'icon'        => 'analytics',
      'keywords'    => ['hdltheme','pingday', 'blog'],
   ],
  
   
] );  