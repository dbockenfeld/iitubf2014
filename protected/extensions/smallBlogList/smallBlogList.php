<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of smallBlogList
 *
 * @author parallels
 */
class smallBlogList extends CWidget {
    
    private $posts = array();

    public function init() {
        parent::init();
    }

    public function run() {
        $criteria = new CDbCriteria();
        $criteria->order = 'date DESC';
        $criteria->compare('active', 1);
        $criteria->limit = 3;
        $this->posts = BlogPosts::model()->findAll($criteria);

        $this->render('smallBlogList', array(
            'posts' => $this->posts,
        ));
    }

}
