<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');

$classes = [
   'pt-100',
   'pb-100',
   'section-grid-block',
];
//print_r($container);



if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php while (have_rows('container')): the_row(); ?>
         <div class="container">
            <div class="row">
               <?php
               $layout_type = get_sub_field('layout');
               $content_text_color = get_sub_field('content_text_color') ? 'has-' . get_sub_field('content_text_color') . '-heading' : '';
               $image = get_sub_field('image');
               if ($layout_type == '3-column'):
               ?>
                  <div class="col-xl-7 col-lg-9 m-auto">
                     <?php if ($image): ?>
                        <div class="icons-content text-center d-block d-lg-none mb-10">
                           <?php echo __get_custom_image($image, 'full', false, ['class' => '']); ?>
                        </div>
                     <?php endif; ?>
                     <div class="text-container text-center <?php echo $content_text_color; ?> extra-pd-sm">
                        <?php echo get_sub_field('intro_content'); ?>
                     </div>
                     <?php if (have_rows('items')): ?>
                        <div class="link-box-wrapper extra-pd-sm mt-50">
                           <div class="row link-box-slider">
                              <?php while (have_rows('items')): the_row(); ?>
                                 <?php
                                 $bg_color = get_sub_field('bg_color') ? get_sub_field('bg_color') : 'rgb(116, 195, 204)';
                                 $text_color = get_sub_field('text_color') ? get_sub_field('text_color') : 'rgb(255, 255, 255)';
                                 $hover_bg_color = get_sub_field('hover_bg_color') ? get_sub_field('hover_bg_color') : '#59B5C1';
                                 $hover_text_color = get_sub_field('hover_text_color') ? get_sub_field('hover_text_color') : '#ffffff';
                                 ?>
                                 <div class="col-lg-4 slider-col">
                                    <div class="single-box text-center" style="background-color:<?php echo $bg_color; ?>; color: <?php echo $text_color; ?>;" hover-bg="<?php echo $hover_bg_color; ?>" hover-color="<?php echo $hover_text_color; ?>">
                                       <?php
                                       $link = get_sub_field('link');
                                       if ($link):
                                          $link_url = $link['url'];
                                          $link_title = $link['title'];
                                          $link_target = $link['target'] ? $link['target'] : '_self';
                                       ?>
                                          <a class="whole-link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"></a>
                                       <?php endif; ?>
                                       <div class="text-content">
                                          <?php echo get_sub_field('content'); ?>
                                       </div>
                                    </div>
                                 </div>
                              <?php endwhile; ?>
                           </div>
                        </div>
                     <?php endif; ?>
                  </div>
               <?php else: ?>
                  <div class="col-xl-6 col-lg-8 m-auto">
                     <div class="text-container text-center <?php echo $content_text_color; ?> extra-pd-sm">
                        <?php echo get_sub_field('intro_content'); ?>
                     </div>
                  </div>
                  <?php if (have_rows('items')): ?>
                     <div class="col-xl-9 col-lg-11 m-auto">
                        <div class="link-box-wrapper extra-pd-sm mt-20">                           
                              <div class="row link-box-slider">
                                 <?php while (have_rows('items')): the_row(); ?>
                                    <?php
                                    $bg_color = get_sub_field('bg_color') ? get_sub_field('bg_color') : 'rgb(116, 195, 204)';
                                    $text_color = get_sub_field('text_color') ? get_sub_field('text_color') : 'rgb(255, 255, 255)';
                                    $hover_bg_color = get_sub_field('hover_bg_color') ? get_sub_field('hover_bg_color') : '#59B5C1';
                                    $hover_text_color = get_sub_field('hover_text_color') ? get_sub_field('hover_text_color') : '#ffffff';
                                    ?>
                                    <div class="col-lg-3 slider-col">
                                       <div class="single-box text-center" style="background-color:<?php echo $bg_color; ?>; color: <?php echo $text_color; ?>;" hover-bg="<?php echo $hover_bg_color; ?>" hover-color="<?php echo $hover_text_color; ?>">
                                          <?php
                                          $link = get_sub_field('link');
                                          if ($link):
                                             $link_url = $link['url'];
                                             $link_title = $link['title'];
                                             $link_target = $link['target'] ? $link['target'] : '_self';
                                          ?>
                                             <a class="whole-link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"></a>
                                          <?php endif; ?>
                                          <div class="text-content">
                                             <?php echo get_sub_field('content'); ?>
                                          </div>
                                       </div>
                                    </div>
                                 <?php endwhile; ?>
                              </div>
                        </div>
                     </div>
                  <?php endif; ?>
               <?php endif; ?>

            </div>
         </div>
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>