<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');

$classes = [
   'pt-80',
   'pb-80',
   'section-cta-block',
];
//print_r($container);
if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php while (have_rows('container')): the_row(); 
       $content_bg_color = get_sub_field('content_bg_color') ? 'background-color-' . get_sub_field('content_bg_color') : 'background-color-purple';
       $content_text_color = get_sub_field('content_text_color') ? 'text-color-' . get_sub_field('content_text_color') : 'text-color-white';
      ?>
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="text-banner <?php echo $content_bg_color.' '.$content_text_color;?> text-center extra-mg-sm">
                     <div class="banner-content">
                        <?php echo get_sub_field('content') ?>
                        <?php
                        $btn_color = get_sub_field('btn_color') ? get_sub_field('btn_color') . '-btn' : '';
                        $link = get_sub_field('link');
                        if ($link):
                           $link_url = $link['url'];
                           $link_title = $link['title'];
                           $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                           <div class="btn-wrapper mt-30">
                              <a class="theme-btn <?php echo $btn_color; ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                 <?php echo $link_title; ?>
                              </a>
                           </div>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>