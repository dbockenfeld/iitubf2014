<section class="item sidebar">
    <img src="/images/hero/sidebar/daily-bread.jpg" alt="Daily Bread" class="sidebar-header"/>
    <section class="item-right">
        <a href="/dailybread">
            <article class="dbkv">
                <h4><?php echo $model->title; ?></h4>
                <p class="passage"><?php echo $model->passage; ?></p>
                <p><strong>Key Verse:</strong> <?php echo substr($model->key_verse, strpos($model->key_verse, ' ', substr_count($model->key_verse, ' ')) + 1); ?></p>
                <?php echo $text; ?>
            </article>
        </a>
    </section>

</section>
