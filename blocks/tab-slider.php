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
   'section-tab-slider',
   'two-cols-slider',
];

if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php
      while (have_rows('container')): the_row();
      ?>
         <div class="container">
            <div class="row gutter-width-50">
               <div class="col col-main-slider">
                  <?php if (have_rows('items')): ?>
                     <div class="main-slider extra-pd-sm" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200"
                        data-aos-easing="linear">
                        <?php while (have_rows('items')): the_row();
                           $content_bg_color = get_sub_field('content_bg_color') ? 'background-color-' . get_sub_field('content_bg_color') : 'background-color-purple';
                           $content_text_color = get_sub_field('content_text_color') ? 'text-color-' . get_sub_field('content_text_color') : 'text-color-white';
                        ?>
                           <div class="single-slide">
                              <div class="boxed-content <?php echo $content_bg_color; ?> shadow-left <?php echo $content_text_color; ?> br-170">
                                 <?php echo get_sub_field('content'); ?>
                                 <?php
                                 $btn_color = get_sub_field('btn_color') ? get_sub_field('btn_color') . '-btn' : '';
                                 $link = get_sub_field('button');
                                 if ($link):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                 ?>
                                    <div class="btn-wrapper mt-20">
                                       <a class="theme-btn <?php echo $btn_color; ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                          <?php echo $link_title; ?>
                                       </a>
                                    </div>
                                 <?php endif; ?>
                                 
                              </div>
                           </div>
                        <?php endwhile; ?>
                     </div>
                  <?php endif; ?>
                  <?php
                  //$btn_color = get_sub_field('btn_color') ? get_sub_field('btn_color') . '-btn' : '';
                  $link = get_sub_field('view_more_button');
                  if ($link):
                     $link_url = $link['url'];
                     $link_title = $link['title'];
                     $link_target = $link['target'] ? $link['target'] : '_self';
                  ?>
                     <div class="btn-wrapper text-center mt-100 d-block d-lg-none">
                        <a class="theme-btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                           <?php echo $link_title; ?>
                        </a>
                     </div>
                  <?php endif; ?>
               </div>
               <?php if (have_rows('items')): ?>
                  <div class="col col-thumbnail-slider">
                     <div class="thumbnail-slider">
                        <?php while (have_rows('items')): the_row(); ?>
                           <div class="single-slide">
                              <p><?php echo get_sub_field('title'); ?></p>
                           </div>
                        <?php endwhile; ?>
                     </div>
                  <?php endif; ?>

                  <?php
                  //$btn_color = get_sub_field('btn_color') ? get_sub_field('btn_color') . '-btn' : '';
                  $link = get_sub_field('view_more_button');
                  if ($link):
                     $link_url = $link['url'];
                     $link_title = $link['title'];
                     $link_target = $link['target'] ? $link['target'] : '_self';
                  ?>
                     <div class="btn-wrapper mt-25 d-none d-lg-block">
                        <a class="theme-btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                           <?php echo $link_title; ?>
                        </a>
                     </div>
                  <?php endif; ?>
                  </div>
            </div>           
         </div>
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>