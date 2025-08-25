<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');
$content_text_color = $container['content_text_color'] ? 'text-color-' . $container['content_text_color'] : 'text-color-orange';


$classes = [
   'pt-80',
   'pb-80',
   'section-steps-box-block',
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
                  <?php if (get_sub_field('section_title')): ?>
                     <div class="section-title <?php echo $content_text_color; ?> mb-45">
                        <h2><?php echo get_sub_field('section_title'); ?></h2>
                     </div>
                  <?php endif; ?>
                  <?php if (have_rows('items')): ?>
                     <div class="steps-boxed-block">
                        <div class="row">
                           <div class="col-xl-8 col-lg-10 m-auto">
                              <?php $i = 1;
                              while (have_rows('items')): the_row();
                                 $content_bg_color = get_sub_field('content_bg_color') ? 'background-color-' . get_sub_field('content_bg_color') : 'background-color-orange';
                                 $content_text_color = get_sub_field('content_text_color') ? 'text-color-' . get_sub_field('content_text_color') : 'text-color-white';

                                 $direction = ($i % 2 == 1) ? 'right' : 'left';
                              ?>
                                 <div class="single-step" data-aos="fade-<?php echo $direction; ?>" data-aos-duration="1000" data-aos-delay="200"
                                    data-aos-easing="linear">
                                    <div
                                       class="boxed-content <?php echo $content_bg_color; ?> shadow-<?php echo $direction == 'right' ? 'left' : 'right'; ?> <?php echo $content_text_color; ?> text-center br-140">
                                       <?php echo get_sub_field('content'); ?>
                                       <?php if ($i == 1): ?>
                                          <div class="search-form-wrapper mt-40">
                                             <div class="form-wrapper">
                                                <form action="" method="get" _lpchecked="1" role="search">
                                                   <div class="input-group">
                                                      <input type="text" class="search form-control" placeholder="Search"
                                                         name="s" value="" required="">
                                                   </div>
                                                   <button type="submit" class=""><span
                                                         class="icon-search"></span></button>

                                                </form>
                                             </div>
                                          </div>
                                       <?php endif; ?>                                       
                                       <?php
                                       $btn_color = get_sub_field('btn_color') ? get_sub_field('btn_color') . '-btn' : '';
                                       $link = get_sub_field('button');
                                       if ($link):
                                          $link_url = $link['url'];
                                          $link_title = $link['title'];
                                          $link_target = $link['target'] ? $link['target'] : '_self';
                                       ?>
                                          <div class="btn-wrapper mt-40">
                                             <a class="theme-btn <?php echo $btn_color; ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                <?php echo $link_title; ?>
                                             </a>
                                          </div>
                                       <?php endif; ?>
                                    </div>
                                 </div>
                              <?php $i++;
                              endwhile; ?>


                           </div>
                        </div>
                     </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>

      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>