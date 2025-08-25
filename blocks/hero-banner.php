<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');

$classes = [
   'section-hero-block',
   'hero-block',
   'overflow-hidden',
];
//print_r($container);

$small_hero = '';

if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <div class="hero-slider-wrapper">
      <?php if ($container['items']): ?>
         <div class="hero-slider <?php echo is_front_page() ? 'home-hero' : ''; ?> position-relative">

            <?php
            foreach ($container['items'] as $item):
               $content_bg = get_sub_field('content_bg_color') ? get_sub_field('content_bg_color') : 'orange';
               $content_text_color = get_sub_field('content_text_color') ? get_sub_field('content_text_color') : 'white';
            ?>
               <div class="single-slide">
                  <div class="slider-bg">
                     <?php
                     $image = wp_get_attachment_image($item['image'], 'full', false, array('class' => 'main-img'));
                     echo preg_replace('/(width|height)="\d*"\s/', '', $image);
                     ?>
                  </div>
                  <div class="slider-content-wrapper h-100">
                     <div class="container">
                        <div class="row">
                           <div class="col-xl-7 col-lg-9 m-auto">
                              <div class="slider-content">
                                 <div class="slider-text-content" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200"
                                    data-aos-easing="linear">
                                    <div class="boxed-content background-color-<?php echo $content_bg; ?> shadow-left text-color-<?php echo $content_text_color; ?> text-center br-230">
                                       <?php echo $item['content']; ?>
                                    </div>
                                 </div>
                                 <?php if ($item['buttons']): ?>
                                    <div class="btn-wrapper text-right" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200"
                                       data-aos-easing="linear">
                                       <?php foreach ($item['buttons'] as $btn):
                                          //print_r($btn); 
                                          $btn_color = $btn['btn_color'] ? $btn['btn_color'] . '-btn' : '';
                                       ?>
                                          <?php if ($btn['link']): ?>
                                             <a href="<?php echo esc_url($btn['link']['url']); ?>" class="theme-btn big-btn has-no-round-span text-left alt2 <?php echo $btn_color; ?>" <?php echo $btn['link']['target'] == '_blank' ? ' target="_blank"' : ''; ?>>
                                                <?php echo esc_html($btn['link']['title']); ?>
                                                <span class="icon-right-arrow"></span>
                                             </a>
                                          <?php endif; ?>
                                       <?php endforeach; ?>
                                    </div>
                                 <?php endif; ?>
                                  <?php if(get_sub_field('enable_search')):?>           
                                 <div class="boxed-content background-color-purple text-color-white text-center br-230 mt-160 d-block d-md-none">
                                    <?php if(get_sub_field('search_title')):?>
                                    <h4><?php echo get_sub_field('search_title');?></h4>
                                    <?php endif;?>
                                    <div class="search-form-wrapper mt-40">
                                       <div class="form-wrapper">
                                          <form action="" method="get" role="search">
                                             <div class="input-group">
                                                <input type="text" class="search form-control" placeholder="Sök efter adress här…" name="s"
                                                   value="" required="">
                                             </div>
                                             <button type="submit" class=""><span class="icon-search"></span></button>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                                 <?php endif;?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            <?php endforeach; ?>
         </div>
      <?php endif; ?>
   </div>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>