<a href="<?php echo $sermon->makeSermonUrl();?>">
    <article class="sermon small-sermon transition scale-small">
        <section class="caption">
            <section class="words">
                <div class="title"><?php echo $sermon->title; ?></div>
                <div class="passage"><?php echo $sermon->getSermonPassage(); ?></div>
            </section>
            <div class="clear"></div>
        </section>
    </article>
</a>