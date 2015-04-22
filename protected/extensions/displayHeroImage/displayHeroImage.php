<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of heroImage
 *
 * @author parallels
 */
class displayHeroImage extends CWidget {

    public $location;
    public $current_page = '';
    private $full_image_list;
    private $image_list;

    public function init() {
        parent::init();
    }

    public function run() {
        $criteria = new CDbCriteria();
        $criteria->compare('active', 1);
        
        $criteria2 = new CDbCriteria();
        $criteria2->addNotInCondition('link', array($this->current_page, 'dailybread'));
        $criteria2->addInCondition('link', array(null), 'OR');
        
        $criteria->mergeWith($criteria2);
        

        $this->image_list = HeroImage::model()->findAll($criteria);

        foreach ($this->image_list as $hero) {
            for ($i = 0; $i < $hero->weight; $i++) {
                $this->full_image_list[] = $hero;
            }
        }
        
        $chosen = $this->full_image_list[rand(0, count($this->full_image_list) - 1)];
        $this->render('displayHeroImage',array(
            'image' => $chosen,
            'location' => $this->location, 
        ));
    }

}
