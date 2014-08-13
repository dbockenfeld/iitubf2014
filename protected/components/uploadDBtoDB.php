<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of uploadDBtoDB
 *
 * @author parallels
 */
class uploadDBtoDB {

    public function strtotitle($title) {
// Converts $title to Title Case, and returns the result.
// Our array of 'small words' which shouldn't be capitalised if
// they aren't the first word. Add your own words to taste.
        $smallwordsarray = array(
            'of', 'a', 'the', 'and', 'an', 'or', 'nor', 'but', 'is', 'if', 'then', 'else', 'when',
            'at', 'from', 'by', 'on', 'off', 'for', 'in', 'out', 'over', 'to', 'into', 'with'
        );

// Split the string into separate words
        $words = explode(' ', $title);

        foreach ($words as $key => $word) {
// If this word is the first, or it's not one of our small words, capitalise it
// with ucwords().
            if ($key == 0 or ! in_array($word, $smallwordsarray))
                $words[$key] = ucwords($word);
        }

// Join the words back into a string
        $newtitle = implode(' ', $words);

        return $newtitle;
    }

    public function archive() {
        $today = date('Y-m-d');

        $db_today = DailyBreadArchive::model()->findByAttributes(array('date' => $today));

        if (!$db_today) {

            $xmlstr = simplexml_load_file('http://ubf.org/dbrss.php');

            $text = str_replace('</h3></p></b>', '</h3>', str_replace('<b><p align="center"><h3>', '<h3>', $xmlstr->channel->item->description));
            $regex_title = "#<h3>(.*?)</h3>#";
            $search = preg_match($regex_title, $text, $matches);

            $title = uploadDBtoDB::strtotitle(strtolower(strip_tags($matches[0])));

            $regex_passage = "#<a (.*?)</a>#";
            $search = preg_match($regex_passage, $text, $matches);

            $passage = strip_tags($matches[0]);

            $book = substr($passage, 0, strpos($passage, ' '));

            $regex_kv = "#<br />Key Verse: (.*?)<br />#";
            $search = preg_match($regex_kv, $text, $matches);

            $key_verse = $book . strip_tags(str_replace('Key Verse: ', ' ', $matches[0]));

            $regex_text = "#<div(.*?)</div>#";
            $search = preg_match($regex_text, $text, $matches);

            $db_text = str_replace('<br /><br /><br />', '</p><p>', str_replace('<br /><br /><br /></div>', '</p>', str_replace('<div align=justify><br />', '<p>', $matches[0])));

            $regex_prayer = "#<i>(.*?)</i>#";
            $search = preg_match($regex_prayer, $text, $matches);

            $prayer = strip_tags(str_replace('Prayer: ', ' ', $matches[0]));

            $regex_ow = "#<b>(.*?)</b>#";
            $search = preg_match($regex_ow, $text, $matches);

            $one_word = strip_tags(str_replace('One Word: ', ' ', $matches[0]));

            $namespaces = $xmlstr->channel->getNameSpaces(true);
            //Now we don't have the URL hard-coded
            $dc = $xmlstr->channel->children($namespaces['dc']);
//            echo $dc->date;

            $model = new DailyBreadArchive();

            $model->date = $dc->date;
            $model->title = trim($title);
            $model->passage = trim($passage);
            $model->key_verse = trim($key_verse);
            $model->text = $db_text;
            $model->prayer = trim($prayer);
            $model->one_word = trim($one_word);

            $model->save();
        }
    }

}
