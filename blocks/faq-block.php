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
   'section-faq-block',
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
         if (get_sub_field('decoration_image')):
      ?>
            <img src="<?php echo get_sub_field('decoration_image'); ?>" alt="decoration-image" class="bg-img">
         <?php endif; ?>
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <?php if (get_sub_field('section_title')): ?>
                     <div class="section-title extra-pd-sm mb-50">
                        <h2><?php echo get_sub_field('section_title'); ?></h2>
                     </div>
                  <?php endif; ?>

                  <div class="tab-accordion-block extra-pd-sm">
                     <div class="row">
                        <div class="col-lg-4 col-md-5">
                           <div class="tab-text-block">
                              <?php if (have_rows('items')): ?>
                                 <div class="tab-block">
                                    <div class="pills-tab-wrapper">
                                       <div class="pills-opener d-md-none">
                                          <span class="icon-down-arrow"></span>
                                       </div>
                                       <ul class="nav nav-pills flex-column nav-pills-alt" id="pills-tab" role="tablist">
                                          <?php $i = 1;
                                          while (have_rows('items')): the_row();

                                          ?>
                                             <li class="nav-item">
                                                <a class="nav-link <?php echo $i == 1 ? 'active' : ''; ?>" id="pills-<?php echo $i; ?>-tab" data-toggle="pill"
                                                   href="#pills-<?php echo $i; ?>" role="tab" aria-controls="pills-<?php echo $i; ?>"
                                                   aria-selected="true"><?php echo get_sub_field('title'); ?></a>
                                             </li>
                                          <?php $i++;
                                          endwhile; ?>
                                       </ul>
                                    </div>
                                 </div>
                              <?php endif; ?>
                              <div class="text-container d-none d-md-block mt-35">
                                 <?php echo get_sub_field('bottom_content'); ?>

                                 <?php
                                 $btn_color = get_sub_field('btn_color') ? get_sub_field('btn_color') . '-btn' : '';
                                 $link = get_sub_field('view_more_button');
                                 if ($link):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                 ?>
                                    <div class="btn-wrapper mt-25">
                                       <a class="theme-btn <?php echo $btn_color; ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                          <?php echo $link_title; ?>
                                       </a>
                                    </div>
                                 <?php endif; ?>

                              </div>
                           </div>
                        </div>
                        <div class="col-lg-7 col-md-6 offset-md-1">
                           <?php if (have_rows('items')): ?>
                              <div class="tab-content" id="pills-tabContent">
                                 <?php $i = 1;
                                 while (have_rows('items')): the_row();
                                    if (have_rows('faq')):
                                 ?>
                                       <div class="tab-pane fade <?php echo $i == 1 ? 'show active' : ''; ?>" id="pills-<?php echo $i; ?>" role="tabpanel"
                                          aria-labell;edby="pills-<?php echo $i; ?>-tab">
                                          <div class="tab-pane-wrapper">
                                             <div class="custom-accordion Accordions">
                                                <?php //$i = 1;
                                                while (have_rows('faq')): the_row(); ?>
                                                   <div class="Accordion_item">
                                                      <div class="title_tab">
                                                         <h4><?php echo get_sub_field('title'); ?></h4>
                                                      </div>
                                                      <div class="inner_content">
                                                         <?php echo get_sub_field('content'); ?>
                                                      </div>
                                                   </div>
                                                <?php endwhile; ?>

                                             </div>
                                          </div>
                                       </div>
                                 <?php
                                    endif;
                                    $i++;
                                 endwhile; ?>
                              </div>
                           <?php endif; ?>
                           <div class="text-container d-block d-md-none mt-35">
                              <?php echo get_sub_field('bottom_content'); ?>
                              <?php
                              $btn_color = get_sub_field('btn_color') ? get_sub_field('btn_color') . '-btn' : '';
                              $link = get_sub_field('view_more_button');
                              if ($link):
                                 $link_url = $link['url'];
                                 $link_title = $link['title'];
                                 $link_target = $link['target'] ? $link['target'] : '_self';
                              ?>
                                 <div class="btn-wrapper mt-25">
                                    <a class="theme-btn <?php echo $btn_color; ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                       <?php echo $link_title; ?>
                                    </a>
                                 </div>
                              <?php endif; ?>
                           </div>
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