<section class="item sidebar">
    <h3>Related Sermons</h3>
    <section class="sermons">
        <?php foreach ($related as $sermon) : ?>
            <?php $this->render('_related_sermon_item', array('sermon' => $sermon)); ?>
        <?php endforeach; ?>
    </section>
</section>