<section class="list">
<ul>
<?php foreach ($list as $item) : ?>
<li class="question-choice" data-index-number="<?php echo $item->id; ?>"><?php echo $item->question; ?></li>
<?php endforeach; ?>
</ul>
</section>