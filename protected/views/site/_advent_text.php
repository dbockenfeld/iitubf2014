<section class="date">
    <section class="month"><?php echo $model->getMonth(); ?></section>
    <section class="day"><?php echo $model->getDay(); ?></section>
    <section class="year"><?php echo $model->getYear(); ?></section>
</section>
<h3><?php echo $model->title ?></h3>
<br/>
<?php if ($model->key_verse) : ?>
    <p class="key-verse"><?php echo $model->key_verse; ?></p>
    <section class="key-verse-text"><?php echo $model->key_verse_text; ?></section>
<?php endif; ?>
<?php echo $model->text; ?>
    <section class="advent-source"><p>This content is from John Piper's book <em>The Dawning of Indestructible Joy</em>. Please see the <a target="_blank" href="http://www.desiringgod.org/books/the-dawning-of-indestructible-joy">Desiring God</a> website for more information.</p></section>

<?php Yii::app()->clientScript->registerCoreScript("jquery"); ?>
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
//    $(document).ready(function() {
//        $.ajax({
//            type: 'post',
//            data: {
//                id: <?php // echo $sermon->message_id; ?>
//            },
//            cache: false,
//            url: '<?php // echo $this->createUrl('site/ajaxAddViewLog'); ?>',
//            datatype: 'html',
//        });
//    });
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51c1ea691c714e26"></script>
