<?php foreach($models as $item) : ?>
<?php $this->renderPartial('_sermon_series_filter_item',array(
    'item' => $item,
)); ?>
<?php endforeach; ?>
