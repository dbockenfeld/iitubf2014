<section class="content">
    <section class="content-body zero-font">
        <!--<h2><?php echo $data->title; ?></h2>-->
        <section class="full-width event-page">
            <section class="item event-page-item">
                <?php if ($data->image != '') : ?>
                    <div class="<?php echo isset($image_class) ? $image_class : 'page-header'; ?>">
                        <?php echo CHtml::image(Yii::app()->baseUrl . '/images/' . $data->image, $data->title); ?>
                    </div>
                <?php endif; ?>
                <?php echo $data->text; ?>
            </section>
        </section>
    </section>
</section>