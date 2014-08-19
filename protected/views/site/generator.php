<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function titleToURL($title) {
    $data = str_replace(" ", "-", $title);

    $bad_characters = array("'", ":", ";", ".", ",", "!", "?",);
    $data = str_replace($bad_characters, "", $data);
    $url = $data;
    return $url;
}

foreach ($sermons as $sermon) {
    echo 'RewriteCond %{QUERY_STRING} title=' . titleToURL($sermon->title) . '&date=' . $sermon->sermon_date . '$ [NC]<br/>';
    echo 'RewriteRule ^bible-study/sermon\.php$ ' . $sermon->makeSermonUrl() . '? [L,R=302]<br/>';
}