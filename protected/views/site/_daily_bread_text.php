<?php if ($model->intro_title != '') : ?>
    <h3><?php echo $model->intro_title; ?></h3>
    <?php echo $model->intro_text; ?>
<?php endif; ?>
<h3><?php echo $model->title ?></h3>
<p class="sermon-passage"><?php echo $model->passage; ?></p>
<?php if ($model->key_verse) : ?>
    <p class="key-verse">Key Verse: <?php echo substr($model->key_verse,strpos($model->key_verse, ' ', substr_count($model->key_verse, ' '))+1); ?></p>
    <section class="key-verse-text"><?php echo $model->key_verse_text; ?></section>
<?php endif; ?>
<?php echo $model->text; ?>
<p><i>Prayer: <?php echo $model->prayer; ?></i></p>
<p><strong>One Word: <?php echo $model->one_word; ?></strong></p>
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
