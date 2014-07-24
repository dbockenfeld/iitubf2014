<a href="<?php echo $post->makePostUrl(); ?>">
<article class="blog">
    <p class="home-blog-title"><?php echo $post->title; ?></p>
    <p class="home-blog-summary"><?php echo strip_tags($post->summary); ?></p>
</article>
</a>