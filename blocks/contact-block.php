<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');
$content_bg = $container['content_bg_color'] ? 'background-color-' . $container['content_bg_color'] : 'background-color-purple';
$content_text_color = $container['content_text_color'] ? 'text-color-' . $container['content_text_color'] : 'text-color-white';

$classes = [
   'pt-80',
   'pb-80',
   'section-contact-block',
   $content_bg,
   $content_text_color
];
//print_r($container);
if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php while (have_rows('container')): the_row();

      ?>
         <div class="container">
            <div class="row">
               <div class="col-xl-6 col-lg-8 col-md-10 m-auto">
                  <div class="text-container text-center">
                     <?php echo get_sub_field('content'); ?>
                  </div>
                  <?php $form_id = get_sub_field('select_form'); ?>
                  <?php if ($form_id): ?>
                     <div class="form-block mt-40">
                        <?php echo do_shortcode('[gravityform id="' . $form_id . '" title="false" description="false" ajax="true"]'); ?>
                     </div>
                  <?php endif; ?>
               </div>

            </div>
         </div>
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>