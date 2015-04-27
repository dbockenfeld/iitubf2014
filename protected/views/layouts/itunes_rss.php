<?php header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>

<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">

<channel>

<title><?php echo $this->rssTitle; ?></title>

<link>http://www.iitubf.org/sermons</link>

<language>en-us</language>

<copyright>&#x2117; &amp; &#xA9; <?php echo date('Y'); ?> IIT UBF</copyright>

<itunes:subtitle><?php echo $this->rssSubTitle; ?></itunes:subtitle>

<itunes:author>IIT UBF</itunes:author>

<itunes:summary><?php echo $this->rssSummary; ?></itunes:summary>

<description><?php echo $this->rssSummary; ?></description>

<itunes:owner>

<itunes:name>IIT UBF</itunes:name>

<itunes:email>iitubf@gmail.com</itunes:email>

</itunes:owner>

<itunes:image href="http://iitubf.org/images/podcasts/<?php echo $this->rssImage; ?>" />

<itunes:category text="Religion &amp; Spirituality">
    <itunes:category text="Christianity" />
</itunes:category>


<?php echo $content;?>

</channel>

</rss>