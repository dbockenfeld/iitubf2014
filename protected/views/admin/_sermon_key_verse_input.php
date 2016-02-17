<div class="verse-item">
    <?php echo CHtml::dropDownList("verse[$key_verse->id][passage]", $key_verse->passage_id, $key_verse->getPassageList(), array("empty" => "--")); ?>
    <?php echo CHtml::textField("verse[$key_verse->id][verses]", $key_verse->verses); ?>
</div>
