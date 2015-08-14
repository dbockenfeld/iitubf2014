<section class="image-band-section">
    <h4>Most Recent</h4>
    <?php $this->render('_sermon_item_band', array('sermon' => $recent_sermon)); ?>
</section>
<section class="image-band-section">
    <h4>Most Popular</h4>
    <?php foreach ($popular_sermons as $sermon) : ?>
        <?php $this->render('_sermon_item_band', array('sermon' => $sermon)); ?>
    <?php endforeach; ?>
</section>