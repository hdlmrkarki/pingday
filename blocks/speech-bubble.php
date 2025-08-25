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
   'section-speech-bubble',
   'section-has-border section-has-bg-img',
   $content_bg,
   $content_text_color
];

if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>      <?php
      while (have_rows('container')): the_row();
         if (get_sub_field('decoration_image')):
      ?>
            <img src="<?php echo get_sub_field('decoration_image'); ?>" alt="decoration-image" class="bg-img">
         <?php endif; ?>
         <div class="container">
            <div class="row gutter-width-100 row-gap-0">

               <?php if (have_rows('items')):
                  while (have_rows('items')): the_row();
                     $image_position = get_sub_field('image_position') ? 'left' : 'right';
                     
                     $image = get_sub_field('image');
               ?>
                     <div class="col-md-6">
                        <div class="speech-bubble <?php echo $image_position;?>-bubble ml-0 ml-md-auto" data-aos="fade-<?php echo $image_position=='left'?'right':'';?>" data-aos-duration="1000"
                           data-aos-delay="200" data-aos-easing="linear">
                           <h3><?php echo get_sub_field('content'); ?></h3>
                           <?php echo __get_custom_image($image,'full');?>
                        </div>
                     </div>                     
                  <?php endwhile; ?>
               <?php endif; ?>
            </div>
         </div>
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>