<div class="col-md-4">
   <div class="single-result img-text-block">
      <div class="single-block vertical">
         <div class="row no-gutters row-gap-0">
            <div class="col-md-12">
               <a href="<?php echo get_the_permalink(); ?>">
                  <div class="img-container">
                     <?php
                     $image = get_the_post_thumbnail(get_the_ID(), 'medium-large', array('class' => 'w-100'));
                     echo preg_replace('/(width|height)="\d*"\s/', '', $image);
                     ?>
                  </div>
                  <a>
            </div>
            <div class="col-md-12">
               <div class="text-container">
                  <div class="date">
                     <?php
                     echo _e('Published ', 'hdltheme') . get_the_date('j m Y');
                     ?>
                  </div>
                  <h4><?php the_title() ?></h4>

                  <p><?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p>

                  <div class="btn-wrapper mt-10">
                     <a href="<?php echo get_the_permalink(); ?>" class="text-link">
                        <?php
                        echo _e('Läs mer ', 'hdltheme');
                        ?>
                     </a>
                  </div>
                  <div class="badge-wrapper mt-25">
                     <?php
                     $categories = get_the_category();
                     if (! empty($categories)):
                        foreach ($categories as $category) :
                     ?>
                           <div class="single-badge"><?php echo esc_html($category->name); ?></div>
                     <?php endforeach;
                     endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>