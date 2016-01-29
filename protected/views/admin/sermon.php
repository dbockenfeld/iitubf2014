<section class="content">
    <section class="content-body zero-font">
        <h2>IIT UBF Admin</h2>
        <?php if ($data->image != '') : ?>
            <div class="<?php echo isset($image_class) ? $image_class : 'page-header'; ?>">
                <?php echo CHtml::image(Yii::app()->baseUrl . '/images/' . $data->image, $data->title); ?>
            </div>
        <?php endif; ?>
        <section class="left70">
            <section class="item">
                <h3><?php echo $data->short_title; ?></h3>
                <section class="item-right page-content">
                    <section class="date">
                        <section class="month"><?php echo $sermon->getSermonMonth(); ?></section>
                        <section class="day"><?php echo $sermon->getSermonDay(); ?></section>
                        <section class="year"><?php echo $sermon->getSermonYear(); ?></section>
                    </section>
                    <?php echo CHtml::textField('datepicker', $sermon->sermon_date, array("class" => 'datepicker float-right')); ?>
                    <h3 class="sermon-title-edit"><?php echo $sermon->title ?></h3>
                    <p class="sermon-passage"><?php echo $sermon->getSermonPassage(); ?></p>
                    <p class="sermon-author">By: <span class="author-name-edit"><?php echo $sermon->message_author; ?></span></p>
                    <?php if ($sermon->sermonKeyVerses) : ?>
                        <p class="key-verse">Key Verse: <?php echo $sermon->getKeyVerse(); ?></p>
                        <section class="key-verse-text"><?php echo $sermon->getKeyVerseText(); ?></section>
                    <?php endif; ?>
                    <?php if ($sermon->text) : ?>
                        <div class="body-text-edit">
                            <?php echo $sermon->text; ?>
                        </div>
                    <?php else : ?>
                        <?php echo $sermon->message_description; ?>
                    <?php endif; ?>
                </section>
            </section>
        </section>
    </section>
</section>
<script>
    tinymce.init({
        selector: "div.body-text-edit",
        inline: true,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
    tinymce.init({
        selector: "h3.sermon-title-edit",
        inline: true,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "undo redo",
        menubar: false
    });
    tinymce.init({
        selector: "span.author-name-edit, section.key-verse-text",
        inline: true,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "undo redo",
        menubar: false
    });
    var months = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]

    $(document).ready(function () {
        $('.datepicker').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onSelect: function (dateText) {
                var year = dateText.substring(0, 4);
                var month = months[parseInt(dateText.substring(5, 7))];
                var day = parseInt(dateText.substring(8, 10));
                $(this).prev('.date').find('.day').html(day);
                $(this).prev('.date').find('.month').html(month);
                $(this).prev('.date').find('.year').html(year);
//                alert(month);
            }
        });

        $('.date').click(function () {
            $(this).parent().find('.datepicker').datepicker('show');
        });
    });

</script>