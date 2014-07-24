<h3>Articles</h3>
<p></p>
<section class="full-sermon-list">
    <?php
    foreach ($posts as $post) {
        echo $this->renderPartial('_large_post_item', array(
            'post' => $post,
        ));
    }
    ?>
</section>