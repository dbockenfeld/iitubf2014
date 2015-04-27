<item>

<title><?php echo $feed_item->sermon->title; ?></title>

<itunes:author>IIT UBF</itunes:author>

<itunes:subtitle>A sermon from our series <?php echo $feed_item->sermon->series->short_title; ?> covering <?php echo $feed_item->sermon->book->name . ' '. $feed_item->sermon->verses; ?>.</itunes:subtitle>

<itunes:summary><?php echo strip_tags($feed_item->sermon->message_description); ?></itunes:summary>

<itunes:image href="http://iitubf.org/images/podcasts/<?php echo $this->rssImage; ?>" />

<enclosure url="http://iitubf.org/media/podcasts/<?php echo $feed_item->file_location; ?>" length="<?php echo $feed_item->length; ?>" type="<?php echo $feed_item->file_type; ?>" />

<guid>http://iitubf.org/media/podcasts/<?php echo $feed_item->file_location; ?></guid>

<pubDate><?php echo date('D, d M Y H:i:s T',strtotime($feed_item->sermon->sermon_date)); ?></pubDate>

<itunes:duration><?php echo $feed_item->duration; ?></itunes:duration>

</item>
