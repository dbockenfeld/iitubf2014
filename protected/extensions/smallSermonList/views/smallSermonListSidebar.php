<section class="item <?php echo $options['location']; ?>">
    <h3>Most Recent<?php echo $options['location'] == 'homepage' ? '' : ' Sermon' ?></h3>
    <section class="sermons">
        <?php $this->render('_sermon_item', array('sermon' => $recent_sermon, "location" => $options['location'])); ?>
    </section>
</section>
<section class="item <?php echo $options['location']; ?>">
    <h3>Most Popular<?php echo $options['location'] == 'homepage' ? '' : ' Sermons' ?></h3>
    <section class="item-right sermons">
        <?php foreach ($popular_sermons as $sermon) : ?>
            <?php $this->render('_sidebar_sermon_item', array('sermon' => $sermon)); ?>
        <?php endforeach; ?>
    </section>
</section>