<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$upload = get_field( 'upload' );

?>

<?php if( $upload ): ?>
<div class="featured-img br-15">
   
   <?php if( $upload[ 'type' ] == 'image' ): ?>
      <img src="<?php echo esc_url( $upload[ 'url' ] ) ?>" alt="<?php echo esc_attr( $upload[ 'title' ] ) ?>" class="w-100" />
   <?php elseif( $upload[ 'type' ] == 'video' ): ?>
      <video class="banner-video" autoplay="" loop="" playsinline="" poster="">
         <source src="<?php echo esc_url( $upload[ 'url' ] ); ?>" type="video/mp4">
      </video>
   <?php endif; ?>
</div>
<?php endif; ?>