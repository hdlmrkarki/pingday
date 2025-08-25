<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');

$classes = [
   'pt-80',
   'pt-80',
   'section-two-col-img-text',
];

if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php
      while (have_rows('container')): the_row();
      ?>
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <?php if (have_rows('items')):
                     while (have_rows('items')): the_row();
                        $image_position = get_sub_field('image_position') ? 'img-left' : 'img-right';
                        $image_reverse = get_sub_field('image_position') ? '' : 'flex-md-row-reverse';
                        $content_bg_color = get_sub_field('content_bg_color') ? 'background-color-' . get_sub_field('content_bg_color') : 'no-bg';
                        $btn_color = get_sub_field('btn_color') ? get_sub_field('btn_color') . '-btn' : '';
                        $image = get_sub_field('image');
                        $bg_color = get_sub_field('content_bg_color');
                        $center_content = get_sub_field('center_content')?'content-center':'';
                  ?>
                        <div class="two-col-img-text-block extra-pd-sm <?php echo $image?'':'no-img-block';?>">
                           <div class="single-block <?php echo $image_position; ?> <?php echo $bg_color ?' has-curtailed-bg':' no-bg'?>">
                              <?php if(get_sub_field('content_bg_color')):?>
                              <div class="bg <?php echo $content_bg_color; ?>"></div>
                              <?php endif; ?>
                              <div class="row <?php echo $bg_color ?' gutter-width-50':' no-gutters'?> <?php echo $image ? $image_reverse :''; ?>">
                                 <?php if ($image): ?>
                                    <div class="col-md-6">
                                       <div class="img-container <?php echo get_sub_field('image_inner_position')?' text-center':'';?>">
                                          <?php echo __get_custom_image($image, 'large') ?>
                                       </div>
                                    </div>
                                 <?php endif; ?>
                                 <div class="col-md-6">
                                    <div class="text-container-wrapper <?php echo $center_content;?>" data-aos="fade-<?php echo get_sub_field('image_position')?'left':'right';?>" data-aos-duration="1000"
                                       data-aos-delay="200" data-aos-easing="linear">
                                       <div class="text-container">
                                          <?php echo get_sub_field('content'); ?>
                                          <?php
                                          $link = get_sub_field('button');
                                          $remove_style = get_sub_field('remove_btn_style');
                                          if ($link): ?>
                                             <div class="btn-wrapper mt-25">
                                                <a href="<?php echo esc_url($link['url']); ?>" class="<?php echo $remove_style?'text-link':'theme-btn';?>  <?php echo $btn_color; ?>" <?php echo $link['target'] == '_blank' ? ' target="_blank"' : ''; ?>>
                                                   <?php echo esc_html($link['title']); ?>
                                                </a>
                                             </div>
                                          <?php endif; ?>
                                       </div>
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </div>
                     <?php endwhile; ?>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>