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
        $yesterday = date('Y-m-d', strtotime('-1 day'));

        $db_today = DailyBreadArchive::model()->findByAttributes(array('date' => $today));
        $db_yesterday = DailyBreadArchive::model()->findByAttributes(array('date' => $yesterday));
//        $db_today = false;
        if (!$db_today) {


            $xmlstr = simplexml_load_file('http://www.ubf.org/daily-bread.xml');

//            $text = str_replace('</h3></p></b>', '</h3>', str_replace('<b><p align="center"><h3>', '<h3>', $xmlstr->channel->item->description));
            $text = $xmlstr->channel->item->description;
            $regex_title = "#<h2>(.*?)</h2>#";
            $search = preg_match_all($regex_title, $text, $matches);

            if (count($matches[1]) == 1) {
                $intro_title = '';
                $title = uploadDBtoDB::strtotitle(strtolower(strip_tags($matches[1][0])));
            } else {
                $intro_title = uploadDBtoDB::strtotitle(strtolower(strip_tags($matches[1][0])));
                $title = uploadDBtoDB::strtotitle(strtolower(strip_tags($matches[1][1])));
            }

            if ($title != $db_yesterday->title) {

                $matches = array();
                $regex_passage = '#<div class="field field-name-field-daily-bread-verses-long (.*?)</div>#s';
                $regex_passage2 = '#<a(.*?)</a>#s';
                $search = preg_match($regex_passage, $text, $matches);

                $passage = trim(str_replace("Read...", "", strip_tags($matches[0])));

                $book = substr($passage, 0, strpos($passage, ' ', substr_count($passage, ' ')));

                $matches = array();
                $regex_kv = '#<div class="field field-name-field-daily-bread-key-verse-long (.*?)</div></div>#';
                $search = preg_match($regex_kv, $text, $matches);

                $key_verse = trim(strip_tags(str_replace('Key verse:&nbsp;', ' ', $matches[0])));

//            echo "<pre>";
//            print_r($key_verse);
//            echo "<pre>";
//            print_r($text);
//            Yii::app()->end();
                $matches = array();
                $regex_text1 = '#<div class="field field-name-body(.*?)</div>#s';
                $regex_text2 = '#<p(.*?)</p>#s';
                $search = preg_match($regex_text1, $text, $matches);
                $search = preg_match_all($regex_text2, $matches[0], $matches);

                $db_text = str_replace('<br /><br />', '</p><p>', preg_replace("/[\n\r]/", "", implode($matches[0])));

//            echo "<pre>";
//            print_r($db_text);
//            echo "<pre>";
//            print_r($text);
//            Yii::app()->end();
                $matches = array();
                $regex_text = "#</h3>(.*?)<h3>#";
                $search = preg_match($regex_text, $text, $matches);
//            print_r($matches);
//            Yii::app()->end();

                if (!empty($matches)) {
                    $intro_text = str_replace('<br /><br />', '</p><p>', str_replace('<br /><br /><h3>', '</p>', str_replace('</h3><br /><br />', '<p>', $matches[0])));
                } else {
                    $intro_text = '';
                }

                $matches = array();
                $regex_prayer = '#<div class="field field-name-field-daily-bread-prayer(.*?)</div></div>#';
                $search = preg_match($regex_prayer, $text, $matches);

                $prayer = strip_tags(str_replace('Prayer:&nbsp;', ' ', $matches[0]));

                $matches = array();
                $regex_ow = '#<div class="field field-name-field-daily-bread-one-word(.*?)</div></div>#';
                $search = preg_match($regex_ow, $text, $matches);

                $one_word = strip_tags(str_replace('One word:&nbsp;', ' ', $matches[0]));

                $namespaces = $xmlstr->channel->getNameSpaces(true);
                //Now we don't have the URL hard-coded
                $dc = $xmlstr->channel->children($namespaces['dc']);
//            echo $dc->date;

                $model = new DailyBreadArchive();

                $model->date = $today;
                $model->intro_title = trim($intro_title);
                $model->intro_text = $intro_text;
                $model->title = trim($title);
                $model->passage = trim($passage);
                $model->key_verse = trim($key_verse);
                $model->text = $db_text;
                $model->prayer = trim($prayer);
                $model->one_word = trim($one_word);

                $model->save(false);
//        print_r($model->attributes);
//        Yii::app()->end();
            }
        }
    }

}
