<section class="content">
    <section class="content-body zero-font">
        <h2>IIT UBF Admin</h2>
        <form id="sermon-form">
            <?php if ($data->image != '') : ?>
                <div class="<?php echo isset($image_class) ? $image_class : 'page-header'; ?>">
                    <?php echo CHtml::image(Yii::app()->baseUrl . '/images/' . $data->image, $data->title); ?>
                </div>
            <?php endif; ?>
            <section class="left70">
                <?php echo CHtml::hiddenField("sermon_id", $sermon->id); ?>
                <section class="item">
                    <h3><?php echo $data->short_title; ?></h3>
                    <section class="item-right page-content">
                        <section class="date pointer">
                            <section class="month"><?php echo $sermon->getSermonMonth(); ?></section>
                            <section class="day"><?php echo $sermon->getSermonDay(); ?></section>
                            <section class="year"><?php echo $sermon->getSermonYear(); ?></section>
                        </section>
                        <?php echo CHtml::textField('datepicker', $sermon->sermon_date, array("class" => 'datepicker float-right vis-hidden')); ?>
                        <h3 class="sermon-title-edit" id="title"><?php echo $sermon->title ?></h3>
                        <p class="sermon-passage"><?php echo $sermon->sermonPassage; ?></p>
                        <p class="sermon-author">By: <span class="author-name-edit" id="author"><?php echo $sermon->message_author; ?></span></p>
                        <?php if ($sermon->sermonKeyVerses) : ?>
                            <p class="key-verse">Key Verse: <?php echo $sermon->keyVerse; ?></p>
                            <section class="key-verse-text" id="key-verse-text"><?php echo $sermon->keyVerseText; ?></section>
                        <?php endif; ?>
                        <div class="body-text-edit" id="body-text">
                            <?php echo $sermon->text; ?>
                        </div>
                    </section>
                </section>
            </section>
            <section class="right30">
                <section class="item sidebar">
                    <h3>Additional Information</h3>
                    <section class="additional-info">
                        <div class="row">
                            <?php echo CHtml::activeLabel($sermon, "series_id"); ?>
                            <?php echo CHtml::activeDropDownList($sermon, "series_id", Series::getSeriesList(), array("empty" => "--")); ?>
                        </div>
                        <div class="row">
                            <?php echo CHtml::label("Passage", "passage"); ?>
                            <?php foreach ($sermon->sermonPassages as $passage): ?>
                                <?php
                                $this->renderPartial("_sermon_passage_input", array(
                                    "passage" => $passage,
                                ));
                                ?>
                            <?php endforeach; ?>
                            <div class="add-passage">+</div>
                        </div>
                        <div class="row">
                            <?php echo CHtml::activeLabel($sermon, "message_description"); ?>
                            <div class="summary-text-edit" id="summary-text">
                                <?php echo $sermon->message_description; ?>
                            </div>
                        </div>
                        <div class="row">
                            <?php echo CHtml::activeCheckBox($sermon, "active"); ?>
                            <?php echo CHtml::activeLabel($sermon, "active"); ?>
                        </div>
                    </section>
                </section>

            </section>
        </form>
    </section>
</section>
<script>
    var form = "#sermon-form";
    var processing_url = "<?php echo Yii::app()->createUrl("admin/ajaxsermonsave") ?>";
    tinymce.init({
        setup: function (ed) {
            ed.on('keyup', function (ed) {
                editorId = tinymce.activeEditor.id;
                tinyMCE.triggerSave();
                autosave(form, processing_url)
            });
        },
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
        setup: function (ed) {
            ed.on('keyup', function (ed) {
                editorId = tinymce.activeEditor.id;
                tinyMCE.triggerSave();
                autosave(form, processing_url)
            });
        },
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
        setup: function (ed) {
            ed.on('keyup', function (ed) {
                editorId = tinymce.activeEditor.id;
                tinyMCE.triggerSave();
                autosave(form, processing_url)
            });
        },
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
    tinymce.init({
        setup: function (ed) {
            ed.on('keyup', function (ed) {
                editorId = tinymce.activeEditor.id;
                tinyMCE.triggerSave();
                autosave(form, processing_url)
            });
        },
        selector: "div.summary-text-edit",
        inline: true,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "undo redo | bold italic",
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
                tinyMCE.triggerSave();
                save(form, processing_url);
//                alert(month);
            }
        });

        $('.date').click(function () {
            $(this).parent().find('.datepicker').datepicker('show');
        });

        $("body").on('change', "select, input:checkbox", function () {
            save(form, processing_url);
        });

        $("body").on('keyup', "input:text", function () {
            autosave(form, processing_url);
        });

        $("body").on("click", ".add-passage", function () {
            var sermon_id = $("#sermon_id").val();
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: "<?php echo Yii::app()->createUrl("admin/ajaxaddPassage") ?>",
                data: {
                    sermon_id: sermon_id,
                },
                timeout: 5000,
                cache: false,
                success: function (html) {
                    $(".add-passage").before(html)
                    $(".passage-item").last().hide().slideDown();
                },
            });
        });

        $("body").on("click", ".remove-passage", function () {
            var sermon_id = $(this).attr("id").substring(15);
            var item = $(this).parents(".passage-item");
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: "<?php echo Yii::app()->createUrl("admin/ajaxremovePassage") ?>",
                data: {
                    sermon_id: sermon_id,
                },
                timeout: 5000,
                cache: false,
                success: function (html) {
                    item.slideUp().delay(1000).queue(function (n) {
                        $(this).remove();
                        n();
                    });
                },
            });
        });
    });

    function save(form, processing_url) {
        $('#offline').remove();
        tinyMCE.triggerSave();
        $.ajax({
            async: false,
            type: 'POST',
            dataType: 'json',
            url: processing_url,
            data: $(form).serialize(),
            timeout: 5000,
            cache: false,
            success: function () {
            },
            error: function (data) {
                setTimeout(function () {
                    save(form, processing_url);
                }, 5000);
            }
        });
    }

    var timer;
    function autosave(form, processing_url, duration) {
        duration = duration || 1000;
        clearInterval(timer);
        timer = setTimeout(function () {
            save(form, processing_url);
        }, duration);
    }
</script>