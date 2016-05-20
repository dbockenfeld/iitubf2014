<section class="content">
    <section class="content-body zero-font">
        <section class="full-width event-page">
            <section class="item event-page-item intro">
                <div class="sermon-header">
                    <?php echo CHtml::image(Yii::app()->baseUrl . '/images/common/intro.png', "Intro"); ?>
                </div>
                <section class="body-text">
                    <p>This is sample text of what will be in the body area of Intro. This could be instructions and helpful hints.</p>
                </section>
                <section class="intro-body">
                    <section class="intro-input">
                        <?php echo CHtml::textField("intro-field", "", array("placeholder" => "Search...")); ?>
                    </section>
                    <section class="intro-question-list"></section>
                    <section class="intro-result-container"></section>
                </section>
            </section>
        </section>
    </section>
</section>