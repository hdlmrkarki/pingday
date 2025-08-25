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
   'section-press-block',
];
//print_r($container);



if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php while (have_rows('container')): the_row(); ?>
         <?php
         $content_text_color = get_sub_field('content_text_color') ? 'text-color-' . get_sub_field('content_text_color') : 'text-color-orange';
         //$image = get_sub_field('image');

         ?>
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <?php if (get_sub_field('section_title')): ?>
                     <div class="section-heading <?php echo $content_text_color; ?> extra-pd-sm mb-15">
                        <h2><?php echo get_sub_field('section_title'); ?></h2>
                     </div>
                  <?php endif; ?>
                  <div class="two-col-img-text-block two-col-text-block extra-pd-sm">
                     <div class="single-block img-left no-bg">
                        <div class="row no-gutters">
                           <?php if (have_rows('contact_block')):
                              while (have_rows('contact_block')): the_row();
                                 $image = get_sub_field('image');
                           ?>
                                 <div class="col-md-6">
                                    <div class="text-container-wrapper p-0">
                                       <div class="text-container">
                                          <div class="profile-block">
                                             <?php if ($image): ?>
                                                <div class="img-container">
                                                   <?php echo __get_custom_image($image, 'full', false, ['class' => '']); ?>
                                                </div>
                                             <?php endif; ?>
                                             <div class="text-content">
                                                <?php echo get_sub_field('contact_info'); ?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                 </div>
                           <?php endwhile;
                           endif;
                           ?>
                           <?php if (have_rows('download_block')):
                              while (have_rows('download_block')): the_row();
                           ?>
                                 <div class="col-md-6">
                                    <div class="text-container-wrapper aos-init aos-animate" data-aos="fade-left"
                                       data-aos-duration="1000" data-aos-delay="200" data-aos-easing="linear">
                                       <div class="text-container">
                                          <?php if (get_sub_field('title')): ?>
                                             <h4><?php echo get_sub_field('title'); ?></h4>
                                          <?php endif; ?>
                                          <?php if (have_rows('downloads')): ?>
                                             <div class="links-wrapper">
                                                <?php while (have_rows('downloads')): the_row(); ?>
                                                   <?php
                                                   $link_type = get_sub_field('link_type');
                                                   if ($link_type == 'link'):
                                                      $link = get_sub_field('add_link');
                                                      if ($link):
                                                         $link_url = $link['url'];
                                                         $link_title = $link['title'];
                                                         $link_target = $link['target'] ? $link['target'] : '_self';
                                                   ?>
                                                         <a class="text-link fw-regular <?php $arrow; ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                            <?php echo $link_title; ?>
                                                         </a>
                                                      <?php endif;
                                                   else:
                                                      $file = get_sub_field('file');
                                                      //print_r($file);
                                                      if ($file):
                                                      ?>
                                                         <a class="text-link fw-regular has-down-arrow" href="<?php echo esc_url($file['url']); ?>" download>
                                                            <?php echo $file['title']; ?>
                                                         </a>
                                                   <?php endif;
                                                   endif; ?>

                                                <?php endwhile; ?>
                                             </div>
                                          <?php endif; ?>
                                       </div>
                                    </div>
                                 </div>
                           <?php endwhile;
                           endif;
                           ?>
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