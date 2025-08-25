<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');

$classes = [
   'section-post-two-column-content',
];
if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php while (have_rows('container')): the_row();

      ?>
         <div class="profile-block-wrapper mt-70">
            <div class="row">
               <?php if (have_rows('authors')): while (have_rows('authors')): the_row(); ?>
                     <div class="col-md-6">
                        <div class="profile-block">
                           <?php $image = get_sub_field('author_image');
                           if ($image): ?>
                              <div class="img-container">
                                 <?php echo __get_custom_image($image, 'full', false, ['class' => '']); ?>
                              </div>
                           <?php endif; ?>
                           <div class="text-content">
                              <?php echo get_sub_field('author_info'); ?>
                           </div>
                        </div>
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
                  <?php endwhile; ?>
               <?php endif; ?>
            </div>

         </div>
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>