<section class="item homepage">
    <h3>Blog</h3>
    <section class="item-right">
        <?php foreach ($posts as $post) : ?>
        <?php $this->render('_blog_post',array ('post'=>$post)); ?>
        <?php endforeach; ?>
    </section>

</section>
