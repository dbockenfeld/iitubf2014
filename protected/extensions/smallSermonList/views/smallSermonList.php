<section class="item <?php echo $options['location']; ?>">
    <?php if ($options['location'] == 'homepage') : ?>
        <h3>Sermons</h3>
    <?php endif; ?>
    <section class="item-right sermons">
        <h4>Most Recent<?php echo $options['location'] == 'homepage' ? '' : ' Sermon' ?></h4>
        <?php $this->render('_sermon_item', array('sermon' => $recent_sermon, "location" => $options['location'])); ?>
        <h4 class="extra-top-space">Most Popular<?php echo $options['location'] == 'homepage' ? '' : ' Sermons' ?></h4>
        <?php foreach ($popular_sermons as $sermon) : ?>
            <?php $this->render('_sermon_item', array('sermon' => $sermon, "location" => $options['location'])); ?>
        <?php endforeach; ?>
    </section>
</section>