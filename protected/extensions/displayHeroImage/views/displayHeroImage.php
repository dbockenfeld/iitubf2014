<?php
$image_file = $location == 'sidebar' ? $image->sidebar_image : $image->image;
$image_folder = $location == 'sidebar' ? '' : 'hero/';
echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $image_folder . $image_file,'',array('class' => 'hero'));
?>

