<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');

$classes = [
   'pt-150',
   'pb-150',
   'section-simple-text-block',
];
//print_r($container);
if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php while (have_rows('container')): the_row(); 
      //  $content_bg_color = get_sub_field('content_bg_color') ? 'background-color-' . get_sub_field('content_bg_color') : 'background-color-purple';
      //  $content_text_color = get_sub_field('content_text_color') ? 'text-color-' . get_sub_field('content_text_color') : 'text-color-white';
      ?>
         <div class="container">
            <div class="row">
               <div class="col-xl-6 col-lg-8 m-auto">
                  <div class="text-container text-center extra-pd-sm">                     
                        <?php echo get_sub_field('content') ?>               
                  </div>
               </div>
            </div>
         </div>
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>