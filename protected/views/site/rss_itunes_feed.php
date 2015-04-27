<?php

//print_r($feed);

foreach ($feed->podcastSermons as $feed_item) {
    $this->renderPartial('rss_itunes_feed_item', array(
        'feed_item' => $feed_item,
    ));
}

