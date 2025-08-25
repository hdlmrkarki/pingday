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
   'section-number-block',
   $content_bg,
   $content_text_color,
   'section-has-border section-has-bg-img'
];

if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php
      while (have_rows('container')): the_row();
      if (get_sub_field('section_decoration_image')):
      ?>
                  <img src="<?php echo get_sub_field('section_decoration_image'); ?>" alt="decoration-image" class="bg-img">

         <?php endif; ?>
         <div class="container">
            <div class="row">
               <?php  if (get_sub_field('section_title')): ?>
               <div class="col-lg-10 m-auto">
                  <div class="text-container text-center mb-60">
                     <h2><?php echo get_sub_field('section_title'); ?></h2>
                  </div>
               </div>
               <?php endif; ?>

               <?php if (have_rows('items')): ?>
               <div class="col-lg-12">
                  <div class="number-text-block">
                      <?php $i=1;while (have_rows('items')): the_row();
                           $content_bg_color = get_sub_field('content_bg_color') ? 'background-color-' . get_sub_field('content_bg_color') : 'background-color-purple';
                           $content_text_color = get_sub_field('content_text_color') ? 'text-color-' . get_sub_field('content_text_color') : 'text-color-white';

                           $direction= ($i % 2 == 0) ? 'right':'left';
                        ?>
                     <div class="single-block on-<?php echo $direction=='right'?'left':'right';?>" data-aos="fade-<?php echo $direction;?>" data-aos-duration="1000" data-aos-delay="200"
                        data-aos-easing="linear">
                        <div class="boxed-content small-box <?php echo $content_bg_color; ?> shadow-<?php echo $direction=='right'?'left':'right';?> <?php echo $content_text_color; ?> text-center br-120">
                           <span><?php echo get_sub_field('title');?></span>
                        </div>

                        <div class="text-content">
                           <h4><?php echo get_sub_field('content');?></h4>
                        </div>
                     </div>
                     <?php $i++;endwhile;?>                     
                  </div>
               </div>
                <?php endif; ?>
            </div>
         </div>
        
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>