<section class="date">
    <section class="month"><?php echo $sermon->getSermonMonth(); ?></section>
    <section class="day"><?php echo $sermon->getSermonDay(); ?></section>
    <section class="year"><?php echo $sermon->getSermonYear(); ?></section>
</section>
<h3><?php echo $sermon->title ?></h3>
<p class="sermon-passage"><?php echo $sermon->getSermonPassage(); ?></p>
<p class="sermon-author">By: <?php echo $sermon->message_author; ?></p>
<?php if ($sermon->key_verse) : ?>
    <p class="key-verse">Key Verse: <?php echo $sermon->key_verse; ?></p>
    <section class="key-verse-text"><?php echo $sermon->key_verse_text; ?></section>
<?php endif; ?>
<?php if ($sermon->text) : ?>
    <?php echo $sermon->text; ?>
<?php else : ?>
    <?php echo $sermon->message_description; ?>
<?php endif; ?>
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
    $(document).ready(function() {
        $.ajax({
            type: 'post',
            data: {
                id: <?php echo $sermon->message_id; ?>
            },
            cache: false,
            url: '<?php echo $this->createUrl('site/ajaxAddViewLog'); ?>',
            datatype: 'html',
        });
    });
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51c1ea691c714e26"></script>