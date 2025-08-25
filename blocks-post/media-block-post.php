<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');

$classes = [
   'section-post-media-block',
];
if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php while (have_rows('container')): the_row();
         $media_type = get_sub_field('media_type');
         $image = get_sub_field('image');
      ?>
         <div class="media-block-wrapper mt-35 mb-35">
            <div class="media-block">
               <?php if ($media_type == 'mp4'):
                  $poster = get_sub_field('poster_image');
                  $mp4 = get_sub_field('mp4');
               ?>
                  <video class="w-100 video-player" loop="" muted="" playsinline="" poster="<?php echo  $poster; ?>">
                     <source src="<?php echo $mp4; ?>" type="video/mp4">
                  </video>
                  <div class="play-pause-btn">
                     <span class="play-pause-icon text-color-white font-90 fa fa-play"></span>                     
                  </div>
               <?php elseif ($media_type == 'embedded'): ?>
                  <div class="embed-responsive embed-responsive-16by9">
                     <iframe class="embed-responsive-item" src="<?php echo get_sub_field('embedded'); ?>?autoplay=1&muted=1&loop=1&background=1" allowfullscreen allow="autoplay; fullscreen; picture-in-picture"></iframe>
                  </div>
               <?php else: ?>
                  <div class="img-banner extra-pd-sm">
                     <?php echo __get_custom_image($image, 'full', false, ['class' => 'w-100']); ?>
                  </div>
               <?php endif ?>
            </div>
            <div class="media-caption"><?php echo get_sub_field('media_caption'); ?></div>
         </div>
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>