<section class="content">
    <section class="content-body zero-font">
        <h2>IIT UBF Admin</h2>
        <section class="full-width event-page">
            <section class="item event-page-item">
                <?php echo CHtml::image("/images/page-headers/sermon-listing.jpg"); ?>
                <section class="event-page-item-section">
                    <h3>View/Edit Sermons</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Passage</th>
                                <th>Author</th>
                                <th>Inline Text?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sermons as $sermon) : ?>
                                <tr class="sermon-link" data-url="<?php echo Yii::app()->createUrl('admin/sermon', array('id' => $sermon->message_id)); ?>">
                                    <td><?php echo $sermon->message_id; ?></td>
                                    <td><?php echo $sermon->sermon_date; ?></td>
                                    <td><?php echo $sermon->title; ?></td>
                                    <td><?php echo $sermon->sermonPassage; ?></td>
                                    <td><?php echo $sermon->message_author; ?></td>
                                    <td><?php echo $sermon->text ? "Y" : "N"; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
</section>
<script>
    $(document).ready(function ($) {
        $(".sermon-link").click(function () {
            window.document.location = $(this).data("url");
        });
    });
</script>