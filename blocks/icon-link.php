<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');

$classes = [
   'pt-35',
   'pb-35',
   'section-icon-links-block',
];
//print_r($container);



if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php while (have_rows('container')): the_row(); ?>
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="icons-link-block extra-pd-sm">
                     <div class="row">
                        <?php if (have_rows('items')):
                           while (have_rows('items')): the_row();
                        ?>
                              <div class="col-lg-3 col-md-6">
                                 <div class="single-block text-center">
                                    <?php
                                    $link = get_sub_field('link');
                                    if ($link):
                                       $link_url = $link['url'];
                                       $link_title = $link['title'];
                                       $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                       <a class="whole-link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"></a>
                                    <?php endif; ?>                                    
                                    <div class="icons-wrapper">
                                       <?php echo __get_custom_image(get_sub_field('image'),'large')?>
                                       
                                    </div>
                                    <?php if(get_sub_field('title')):?>
                                    <div class="text-link-with-arrow"><?php echo get_sub_field('title')?></div>
                                    <?php endif;?>
                                    
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
      <?php endwhile; ?>
   <?php endif; ?>  
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>