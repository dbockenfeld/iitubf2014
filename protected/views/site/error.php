<section class="content">
    <section class="content-body zero-font">

        <h2>Error <?php echo $code; ?></h2>
        <section class="left70">
            <section class="item">
                <h3>Error <?php echo $code; ?></h3>
                <section class="item-right page-content">

                    <p class="error"><?php echo CHtml::encode($message); ?></p>
                    <p>Please use the navigation at the top of the site to find the page you are looking for.</p>
                </section>
            </section>
        </section>
        <section class="right30">
            <?php
            $this->widget('ext.smallSermonList.smallSermonList', array(
                'options' => array(
                    'location' => 'sidebar',
                ),
            ));
            ?>
            <section class="item sidebar">
                <section class="item-right">
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