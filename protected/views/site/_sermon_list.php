<?php
Yii::app()->clientScript->registerScriptFile('/js/jplist.min.js')
        ->registerCSSFile('/css/jplist.min.css')
        ->registerCSSFile('/css/jplist-iitubf.css');
?>
<script type='text/javascript'>
    $('document').ready(function() {
        $('#sermons').jplist({
            itemsBox: '.list'
            , itemPath: '.list-item'
            , panelPath: '.jplist-panel'
        });
    });
</script>
<h3>Sermon Listing</h3>
<p>Our available sermons are listed below.</p>
<section id="sermons">
    <!-- ios button: show/hide panel -->
    <div class="jplist-ios-button">
        <i class="fa fa-sort"></i>
        jPList Actions
    </div>

    <!-- panel -->
    <div class="jplist-panel box panel-top">						

        <!-- items per page dropdown -->
        <div 
            class="jplist-drop-down" 
            data-control-type="drop-down" 
            data-control-name="paging" 
            data-control-action="paging">

            <ul>
                <li><span data-number="10" data-default="true"> 10 per page </span></li>
                <li><span data-number="25"> 25 per page </span></li>
                <li><span data-number="50"> 50 per page </span></li>
                <li><span data-number="100"> 100 per page </span></li>
                <li><span data-number="all"> view all </span></li>
            </ul>
        </div> 

        <div 
            class="jplist-drop-down"
            data-control-type="drop-down" 
            data-control-name="series-filter" 
            data-control-action="filter">
            <ul>
                <li><span data-path="default">Filter by sermon series</span></li>
<?php echo $this->getSermonSeriesFilterList(); ?>
            </ul>

        </div>
        <div 
            class="jplist-drop-down"
            data-control-type="drop-down" 
            data-control-name="book-filter" 
            data-control-action="filter">
            <ul>
                <li><span data-path="default">Filter by book</span></li>
<?php echo $this->getBookFilterList(); ?>
            </ul>

        </div>
        <br />
        <!-- pagination results -->
        <div 
            class="jplist-label" 
            data-type="Page {current} of {pages}" 
            data-control-type="pagination-info" 
            data-control-name="paging" 
            data-control-action="paging">
        </div>

        <!-- pagination -->
        <div 
            class="jplist-pagination" 
            data-control-type="pagination" 
            data-control-name="paging" 
            data-control-action="paging">
        </div>

    </div>
    <section class="full-sermon-list list">
        <?php
        foreach ($sermons as $sermon) {
            echo $this->renderPartial('_large_sermon_item', array(
                'sermon' => $sermon,
            ));
        }
        ?>
    </section>
    <!-- panel -->
    <div class="jplist-panel box panel-bottom">						
        <!-- pagination results -->
        <div 
            class="jplist-label" 
            data-type="Page {current} of {pages}" 
            data-control-type="pagination-info" 
            data-control-name="paging" 
            data-control-action="paging">
        </div>

        <!-- pagination -->
        <div 
            class="jplist-pagination" 
            data-control-type="pagination" 
            data-control-name="paging" 
            data-control-action="paging">
        </div>

    </div>
</section>