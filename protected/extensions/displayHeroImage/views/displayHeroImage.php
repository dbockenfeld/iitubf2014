<?php
$image_file = $location == 'sidebar' ? $image->sidebar_image : $image->image;
$image_folder = $location == 'sidebar' ? 'hero/sidebar/' : 'hero/';
?>

<?php if ($image->link) : ?>
    <a href="/<?php echo $image->link; ?>">
        <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $image_folder . $image_file, '', array('class' => 'hero')); ?>
    </a>
<?php else : ?>
    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $image_folder . $image_file, '', array('class' => 'hero')); ?>
<?php endif; ?>
