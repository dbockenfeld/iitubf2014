<h3>Sermon Listing</h3>
<p>Our available sermons are listed below.</p>
<section class="full-sermon-list">
    <?php
    foreach ($sermons as $sermon) {
        echo $this->renderPartial('_large_sermon_item', array(
            'sermon' => $sermon,
        ));
    }
    ?>
</section>