<a href="<?php echo $sermon->makeSermonUrl(); ?>">
    <article class="sermon-item transition hover-shadow">
        <section class="sermon-item-top">
            <section class="date">
                <section class="month"><?php echo $sermon->getSermonMonth(); ?></section>
                <section class="day"><?php echo $sermon->getSermonDay(); ?></section>
                <section class="year"><?php echo $sermon->getSermonYear(); ?></section>
            </section>
            <section class="info">
                <div class="title"><?php echo $sermon->title; ?></div>
                <div class="passage"><?php echo $sermon->getSermonPassage(); ?></div>
            </section>
        </section>
        <section class="sermon-image">
            <?php if (isset($sermon->series)) : ?>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo $sermon->series->large_feature; ?>" />
                <p class="series"><?php echo $sermon->series->title; ?></p>
            <?php endif; ?>
        </section>
        <section class="sermon-detail">
            <?php echo $sermon->message_description; ?>
        </section>
    </article>
</a>