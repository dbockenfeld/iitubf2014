<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of smallSermonList
 *
 * @author parallels
 */
class smallSermonList extends CWidget {

    public $options = array(
        'location' => 'homepage',
    );
    private $recent_sermon;
    private $popular_sermons;

    public function init() {
        
    }

    public function run() {

        $offset = date('Y-m-d', strtotime('-1 month'));

        switch ($this->options['location']) {
            case "sidebar":
                $pop_num = 5;
                break;
            case "image-band":
                $pop_num = 3;
                break;
            default:
                $pop_num = 4;
                break;
        }

        $criteria = new CDbCriteria();
        $criteria->order = 'sermon_date DESC';
        $criteria->compare('active', 1);
        $this->recent_sermon = Sermons::model()->find($criteria);

        $connection = Yii::app()->db;
        $sql = "SELECT sermon_id, COUNT(*) AS num
  FROM (
SELECT a.sermon_id, a.ip
  FROM view_log a
 WHERE a.timestamp > '" . $offset . "'
  GROUP BY sermon_id, ip ) reduced
 WHERE sermon_id != " . $this->recent_sermon->message_id . "
 GROUP BY sermon_id
 ORDER BY num DESC, sermon_id DESC
 LIMIT $pop_num";

//        echo $sql;
//        Yii::app()->end();
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        foreach ($rows as $item) {
            $this->popular_sermons[] = Sermons::model()->findByPk($item['sermon_id']);
        }

        if ($this->options['location'] == 'sidebar') {
            $this->render('smallSermonListSidebar', array(
                'options' => $this->options,
                'recent_sermon' => $this->recent_sermon,
                'popular_sermons' => $this->popular_sermons,
            ));
        } elseif ($this->options['location'] == 'image-band') {
            $this->render('smallSermonListBand', array(
                'options' => $this->options,
                'recent_sermon' => $this->recent_sermon,
                'popular_sermons' => $this->popular_sermons,
            ));
        } else {
            $this->render('smallSermonList', array(
                'options' => $this->options,
                'recent_sermon' => $this->recent_sermon,
                'popular_sermons' => $this->popular_sermons,
            ));
        }
    }

}
