<section class="date">
    <section class="month"><?php echo $post->getPostMonth(); ?></section>
    <section class="day"><?php echo $post->getPostDay(); ?></section>
    <section class="year"><?php echo $post->getPostYear(); ?></section>
</section>
<h3><?php echo $post->title ?></h3>
<p class="sermon-author">By: <?php echo $post->author; ?></p>
<?php echo $post->text; ?>
<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'iitubf2013'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script');
        dsq.type = 'text/javascript';
        dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            type: 'post',
            data: {
                id: <?php echo $post->id; ?>
            },
            cache: false,
            url: '<?php echo $this->createUrl('site/ajaxAddBlogViewLog'); ?>',
            datatype: 'html',
        });
    });
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51c1ea691c714e26"></script>