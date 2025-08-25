<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');

$classes = [
   'section-post-two-column-image-content',
];
if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php while (have_rows('container')): the_row();
         $image = get_sub_field('image');
         $image_position = get_sub_field('image_position') ? 'img-left' : 'img-right';
         $image_reverse = get_sub_field('image_position') ? '' : 'flex-md-row-reverse';
      ?>
         <div class="two-col-img-text-block for-blogs extra-pd-sm  mt-70">
            <div class="single-block <?php echo $image_position; ?> no-bg">
               <div class="row gutter-width-50 <?php echo $image_reverse; ?>">
                  <div class="col-md-6">
                     <?php if ($image): ?>
                        <div class="img-container">
                           <?php echo __get_custom_image($image, 'full', false, ['class' => '']); ?>
                        </div>
                     <?php endif; ?>
                  </div>
                  <div class="col-md-6">
                     <div class="text-container-wrapper aos-init aos-animate p-0" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200" data-aos-easing="linear">
                        <div class="text-container">
                           <?php echo get_sub_field('content'); ?>
                           <?php if (have_rows('buttons')): while (have_rows('buttons')): the_row(); ?>
                                 <?php
                                 $link = get_sub_field('button');
                                 $remove_style = get_sub_field('remove_btn_style');
                                 $btn_color = get_sub_field('btn_color') ? get_sub_field('btn_color') . '-btn' : '';
                                 if ($link): ?>
                                    <div class="btn-wrapper mt-25">
                                       <div class="single-badge">
                                          <a href="<?php echo esc_url($link['url']); ?>" class="<?php echo $remove_style ? 'text-link' : 'theme-btn'; ?>  <?php echo $btn_color; ?>" <?php echo $link['target'] == '_blank' ? ' target="_blank"' : ''; ?>>
                                             <?php echo esc_html($link['title']); ?>
                                          </a>
                                       </div>
                                    </div>
                                 <?php endif; ?>
                              <?php endwhile; ?>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>