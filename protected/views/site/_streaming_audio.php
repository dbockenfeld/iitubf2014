<?php Yii::app()->clientScript->registerScriptFile('/js/mediaelement/mediaelement-and-player.min.js'); ?>
<?php // Yii::app()->clientScript->registerCSSFile('/js/mediaelement/mediaelementplayer.css'); ?>
<?php Yii::app()->clientScript->registerCSSFile('/css/mejs-iitubf.css'); ?>
<?php Yii::app()->clientScript->registerScript('mediaelement',"$('audio').mediaelementplayer({features:['playpause','current','progress','duration','volume']});"); ?>
<?php Yii::app()->clientScript->registerScriptFile('/js/lock-box.js'); ?>
<?php Yii::app()->clientScript->registerScript('playlog',"$('.mejs-play').on('click', function() {
        $.ajax({
            type: 'post',
            data: {
                id: $id
            },
            cache: false,
            url: '".$this->createUrl('site/ajaxAddStreamLog')."',
            datatype: 'html',
        });
    });
"); ?>
<section id="lock-anchor"></section>
<section class="item sidebar audio-box">
    <section class="item-right streaming">
        <h4>Streaming Audio</h4>
        <audio id="sermon" controls="controls" preload="preload" style="display: inline-block; width: 261px;">
            <source src="/<?php echo $audio; ?>" type="audio/mpeg">
        </audio>
    </section>
</section>