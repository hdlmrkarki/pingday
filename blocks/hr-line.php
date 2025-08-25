<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;


$container = get_field('container');
$line = $container['green_bg']?'hr-light-green':'hr-light-gray';
$classes = [
   'hr-line',
   $line,
];
if (!empty($container['settings']['show_in_front_end'])):
echo Hdltheme_Builder::section_start($container['section'], $classes);
?>

<div class="container">
   <div class="row">
      <div class="col-lg-12">
         <hr>
      </div>
   </div>
</div>

<?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>