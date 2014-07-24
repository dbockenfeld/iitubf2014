<section class="item sidebar">
    <section class="item-right downloads">
        <h4>Downloads</h4>
        <?php
        foreach ($downloads as $item) {
            $this->renderPartial('_download_item', array(
                'item' => $item,
            ));
        }
        ?>
    </section>
</section>
