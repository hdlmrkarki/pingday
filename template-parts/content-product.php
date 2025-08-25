 <?php 
 $product = wc_get_product( get_the_ID() );

$price_incl_tax = wc_get_price_including_tax( $product );
$price_excl_tax = wc_get_price_excluding_tax( $product );

 ?>
 <div class="swiper-slide single-product-sm-box">
     <div class="img-container-wrapper">
         <div class="icons-block">
             <span class="icon-Heart-icon favorite-icon"></span>
         </div>
         <a href="<?php the_permalink();?>">
             <div class="img-container">
                <?php echo get_the_post_thumbnail( get_the_ID(), 'medium' );?>
             </div>
         </a>
     </div>
     <a href="<?php the_permalink()?>">
         <div class="text-container mt-10">
             <div class="product-name h6"><?php the_title();?></div>
             <div class="price h5"><?php echo $product->get_price_html(); ?></div>
             <p class="small-text">(<?php echo wc_price( $price_excl_tax ); ?> exkl. moms)</p>
         </div>
     </a>
 </div>