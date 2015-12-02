<section class="item sidebar">
    <h3>Downloads</h3>
    <section class="item-right downloads">
        <?php
        foreach ($downloads as $item) {
            $this->renderPartial('_download_item', array(
                'item' => $item,
            ));
        }
        ?>
    </section>
</section>
