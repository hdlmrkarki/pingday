<div class="col-lg-12">
   <div class="single-result img-text-block">
      <div class="single-block horizontal">
         <div class="row no-gutters row-gap-0">
            <div class="col-md-6">
               <div class="img-container">
                  <?php
                  $thumbnail = get_the_post_thumbnail(get_the_ID(), 'medium-large');
                  // Remove width and height attributes
                  $thumbnail = preg_replace('/(width|height)="\d*"\s/', '', $thumbnail);
                  echo $thumbnail;
                  ?>

               </div>
            </div>
            <div class="col-md-6">
               <div class="text-container">
                  <div class="date">
                     <?php
                  echo _e('Published ', 'hdltheme') . get_the_date('j m Y');
                  ?>
                  </div>
                  <h4><?php the_title(); ?></h4>
                  <p><?php
                     $excerpt = get_the_excerpt();
                     $trimmed_excerpt = wp_trim_words($excerpt, 36, '...');
                     echo $trimmed_excerpt;
                     ?>
                  </p>

                  <div class="btn-wrapper mt-25">
                     <a href="<?php the_permalink(); ?>" class="text-link"><?php _e('Läs mer', 'hdltheme'); ?></a>
                  </div>

                  <div class="badge-wrapper mt-25">
                     <?php
                     $categories = get_the_category();
                     if (! empty($categories)):
                        foreach ($categories as $category) :
                     ?>
                           <div class="single-badge"><span><?php echo esc_html($category->name); ?></div>
                     <?php endforeach;
                     endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>