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
class uploadDBtoDB extends CWidget {
    public function init() {
        parent::init();
    }
    
    public function run() {
        $xmlstr = simplexml_load_file('http://ubf.org/dbrss.php');


        $text = str_replace('</h3></p></b>','</h3>',str_replace('<b><p align="center"><h3>', '<h3>', $xmlstr->channel->item->description));
        $regex_title = "#<h3>(.*?)</h3>#";
        $title = preg_match($regex_title, $text,$matches);
        
        echo strip_tags($matches[0]);
        Yii::app()->end();
    }
}
