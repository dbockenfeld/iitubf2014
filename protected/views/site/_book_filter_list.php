<?php foreach($models as $item) : ?>
<?php $this->renderPartial('_book_filter_item',array(
    'item' => $item,
)); ?>
<?php endforeach; ?>
