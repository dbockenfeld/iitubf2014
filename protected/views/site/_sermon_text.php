<section class="date">
    <div class="month"><?php echo date('M', strtotime($sermon->sermon_date)); ?></div>
    <div class="day"><?php echo date('j', strtotime($sermon->sermon_date)); ?></div>
    <div class="year"><?php echo date('Y', strtotime($sermon->sermon_date)); ?></div>
</section>
<h3><?php echo $sermon->title ?></h3>
<p class="sermon-passage"><?php echo $sermon->book->name; ?> <?php echo $sermon->verses; ?></p>
<p class="sermon-author">By: <?php echo $sermon->message_author; ?></p>
<?php if($sermon->key_verse) :?>
<p class="key-verse">Key Verse: <?php echo $sermon->key_verse; ?></p>
<section class="key-verse-text"><?php echo $sermon->key_verse_text; ?></section>
<?php endif; ?>
<?php echo $sermon->text; ?>

