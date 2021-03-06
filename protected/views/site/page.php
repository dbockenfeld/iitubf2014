<section class="content">
    <section class="content-body zero-font">
        <h2><?php echo $data->title; ?></h2>
        <?php if ($data->image != '') : ?>
            <div class="<?php echo isset($image_class) ? $image_class : 'page-header'; ?>">
                <?php echo CHtml::image(Yii::app()->baseUrl . '/images/' . $data->image, $data->title); ?>
            </div>
        <?php endif; ?>
        <section class="left70">
            <section class="item">
                <h3><?php echo $data->short_title; ?></h3>
                <section class="item-right page-content">
                    <?php echo $data->text; ?>
                </section>
            </section>
        </section>
        <section class="right30">
            <?php
            if (isset($sidebar_top)) {
                echo $sidebar_top;
            }

            if ($related) {
                $this->widget('ext.relatedSermonList.relatedSermonList', array(
                    'options' => array(
                        'location' => 'sidebar',
                    ),
                    'sermon_id' => $sermon_id,
                ));
            }
            ?>
            <?php
            $this->widget('ext.smallSermonList.smallSermonList', array(
                'options' => array(
                    'location' => 'sidebar',
                ),
            ));
            ?>
            <?php if (Yii::app()->controller->action->id != 'dailybread') : ?>

                <?php
                $this->widget('ext.dailyBreadVerse.dailyBreadVerse', array(
                    'location' => 'sidebar',
                ));
                ?>
<?php endif; ?>
            <section class="item sidebar">
                <section class="hero-image-sidebar">
                    <?php
                    $this->widget('ext.displayHeroImage.displayHeroImage', array(
                        'location' => 'sidebar',
                        'current_page' => $this->getId() . '/' . $this->getAction()->getId(),
                    ));
                    ?>
                </section>
            </section>

        </section>
    </section>
</section>