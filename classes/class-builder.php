<?php

class Hdltheme_Builder
{

   public static function section_start($setting = [], $classes = [])
   {
      ob_start();
      $pt = $setting['padding_top'];
      $pb = $setting['padding_bottom'];
     

      $id = !empty($setting['id']) ? ' id="' . esc_attr($setting['id']) . '"' : '';

      // Track if padding classes were replaced
      $pt_replaced = false;
      $pb_replaced = false;

      // Replace existing padding classes
      $classes = array_map(function ($class) use ($pt, $pb, &$pt_replaced, &$pb_replaced) {
         if (preg_match('/^pt-\d+$/', $class) && is_numeric($pt)) {
            $pt_replaced = true;
            return 'pt-' . $pt;

         }
         if (preg_match('/^pb-\d+$/', $class) && is_numeric($pb)) {
            $pb_replaced = true;
            return 'pb-' . $pb;
         }
         return $class;
      }, $classes);

      // Add new padding classes only if they weren't replaced and values exist
      if (!$pt_replaced && is_numeric($pt)) {
         $classes[] = 'pt-' . $pt;
      }
      if (!$pb_replaced && is_numeric($pb)) {
         $classes[] = 'pb-' . $pb;
      }

      // Remove any empty classes (if $pt/$pb were falsy)
      $classes = array_filter($classes);

      $classes[] = $setting['class'];

?>
      <section class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo $id; ?>>
      <?php
      return ob_get_clean();
   }

   public static function section_end()
   {
      ob_start();
      ?>
      </section>
      <?php
      return ob_get_clean();
   }

   public static function media_type($settings = [], $image_class = '')
   {
      if ($settings) {

         ob_start();

         if (strtolower($settings['media_type']) == 'upload'): ?>
            <?php if ($settings['upload']['type'] == 'video'): ?>
               <video class="banner-video" autoplay="" loop="" muted="" playsinline="" poster="">
                  <source src="<?php echo esc_url($settings['upload']['url']); ?>" type="video/mp4">
               </video>
            <?php elseif ($settings['upload']['type'] == 'image') : ?>
               <img src="<?php echo esc_url($settings['upload']['url']) ?>" alt="<?php echo esc_attr($settings['upload']['title']) ?>" <?php echo ($image_class) ? " class='" . esc_attr($image_class) . "'" : ''; ?> />
            <?php endif; ?>
         <?php
         elseif (strtolower($settings['media_type']) == 'url' && $settings['url']): ?>
            <div class="video-container upload-url">
               <div class="video-wrapper embed-responsive embed-responsive-16by9">
                  <iframe allowtransparency="true" frameborder="0" scrolling="no" name="wistia_embed"
                     allowfullscreen="" width="100%" height="100%" class="wistia_embed"
                     src="<?php echo esc_url($settings['url']); ?>"
                     data-lf-form-tracking-inspected-lynor8xdmzo8wqjz="true"
                     data-lf-yt-playback-inspected-lynor8xdmzo8wqjz="true"
                     data-lf-vimeo-playback-inspected-lynor8xdmzo8wqjz="true">
                  </iframe>
               </div>
            </div>
<?php endif;
         return ob_get_clean();
      }
   }
}
