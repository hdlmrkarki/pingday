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
   'section-image-block'
];
$image = $container['image'] ? $container['image'] : '';
if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
   if ($image):
   ?>
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="img-banner extra-pd-sm">
                  <?php echo __get_custom_image($image, 'full', false, ['class' => 'w-100']); ?>
               </div>
            </div>
         </div>
      </div>

   <?php endif;
   echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>