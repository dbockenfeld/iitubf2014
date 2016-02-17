<div class="passage-item">
    <?php echo CHtml::dropDownList("passage[$passage->id][book]", $passage->book_id, Books::getBookList(), array("empty" => "--")); ?>
    <?php echo CHtml::textField("passage[$passage->id][verses]", $passage->passage); ?>
    <div class="remove-passage" id="remove-passage-<?php echo $passage->id; ?>">-</div>
</div>
