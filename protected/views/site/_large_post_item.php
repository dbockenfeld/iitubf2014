<a href="<?php echo $post->makePostUrl(); ?>">
    <article class="post-item transition hover-shadow<?php echo !isset($post->header_image) ? ' top-padding': ''?>">
        <?php if (isset($post->header_image)) : ?>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo $post->header_image; ?>" />
        <?php endif; ?>
        <section class="date">
            <section class="month"><?php echo $post->getPostMonth(); ?></section>
            <section class="day"><?php echo $post->getPostDay(); ?></section>
            <section class="year"><?php echo $post->getPostYear(); ?></section>
        </section>
        <section class="info">
            <div class="title"><?php echo $post->title; ?></div>
            <?php echo $post->summary; ?>
        </section>
    </article>
</a>