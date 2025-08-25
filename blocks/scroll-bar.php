<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;


$container = get_field('container');
$classes = [
   'pt-40',
   'pb-40',
   'section-scroll-bar overflow-hidden'
];
$image = $container['scroll_image']?$container['scroll_image'] :'';
if(!$image){
   $image = ASSETS_URL.'scrollbar.png';
}
if (!empty($container['settings']['show_in_front_end'])):
echo Hdltheme_Builder::section_start($container['settings'], $classes);
if($image):
?>

<div class="scrollbar-block">
    <img src="<?php echo $image;?>" alt="multicolor-scroll-image" class="scrollImage">
  </div>

<?php endif;
echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>