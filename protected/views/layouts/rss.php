<?php header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>

<rss version="2.0">

    <channel>

        <title><?php echo $this->rssTitle; ?></title>

        <link><?php echo $this->rssUrl; ?></link>

        <language>en-us</language>

        <copyright>&#x2117; &amp; &#xA9; <?php echo date('Y'); ?> IIT UBF</copyright>

        <description><?php echo $this->rssSummary; ?></description>

        <?php echo $content; ?>

    </channel>

</rss>