<section class="item homepage">
    <h3>Daily Bread</h3>
    <section class="item-right">
        <a href="/dailybread">
            <article class="dbkv">
                <h4><?php echo $model->title; ?></h4>
                <p class="passage"><?php echo $model->passage; ?></p>
                <?php if ($model->key_verse) : ?>
                    <p><strong>Key Verse:</strong> <?php echo substr($model->key_verse, strpos($model->key_verse, ' ', substr_count($model->key_verse, ' ')) + 1); ?></p>
                    <?php echo $text; ?>
                <?php endif; ?>
            </article>
        </a>
    </section>

</section>
