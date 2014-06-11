<article class="sermon">
    <section class="image"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo $sermon->series->large_feature; ?>" /></section>
    <section class="caption">
        <section class="words">
            <div class="title"><?php echo $sermon->title; ?></div>
            <div class="passage"><?php echo $sermon->book->name; ?> <?php echo $sermon->verses; ?></div>
        </section>
        <div class="clear"></div>
    </section>
</article>
