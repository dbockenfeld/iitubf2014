<?php header("Content-type: application/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">

    <channel>

        <title><?php echo $this->rssTitle; ?></title>

        <link><?php echo $this->rssUrl; ?></link>
        <atom:link href="<?php echo $this->rssUrl; ?>" rel="self" type="application/rss+xml" />
        <language>en-us</language>

        <copyright>&#x2117; &amp; &#xA9; <?php echo date('Y'); ?> IIT UBF</copyright>

        <description><?php echo $this->rssSummary; ?></description>

        <?php echo $content; ?>

    </channel>

</rss>