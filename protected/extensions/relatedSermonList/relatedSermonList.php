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
class relatedSermonList extends CWidget {

    public $options = array(
        'location' => 'homepage',
    );
    public $sermon_id;
    protected $sermon;
    private $recent_sermon;
    private $popular_sermons;

    public function init() {
        if ($this->sermon_id) {
            $this->sermon = Sermons::model()->findByPk($this->sermon_id);
        }
    }

    public function run() {
        if ($this->sermon_id) {
            $related = $this->sermon->relatedSermons;
            
            $this->render("relatedSermonList", array(
                "related" => $related,
            ));
        }
    }

}
