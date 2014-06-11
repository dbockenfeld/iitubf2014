<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    public function actionDailyBread() {
        $page_data = Pages::model()->findByAttributes(array(
            'page' => 'daily-bread',
        ));

        $xmlstr = simplexml_load_file('http://ubf.org/dbrss.php');


        $page_data->text = str_replace('</h3></p></b>','</h3>',str_replace('<b><p align="center"><h3>', '<h3>', $xmlstr->channel->item->description));

        $this->render('page', array(
            'data' => $page_data,
        ));
    }

    public function actionSermons() {
        $sermon_name = Yii::app()->request->getParam('name');
        $page_data = new Pages();
        
        $page_data->title = $page_data->short_title = 'Sermons';
        
        if ($sermon_name) {
            $sermon = $this->getSermon($sermon_name);
            $page_data->text = $this->formatSermon($sermon);
            $page_data->image = $sermon->series->large_feature;
        } else {
            $page_data->text = $this->getSermonList();
        }


        $this->render('page', array(
            'data' => $page_data,
            'image_class' => 'sermon-header',
        ));
        
    }
    
    protected function getSermon($name) {
        $criteria = new CDbCriteria();
        $criteria->addCondition('title SOUNDS LIKE "'.$name.'"');
        
        $sermon = Sermons::model()->find($criteria);
//        $sermon->text = $name;
        return $sermon;
    }
    
    protected function getSermonList() {
        return 'Sermon List';
    }
    
    protected function formatSermon($sermon) {
        return $this->renderPartial('_sermon_text', array(
            'sermon' => $sermon,
        ), true);
    }

    public function actionAbout() {
        $page_data = Pages::model()->findByAttributes(array(
            'page' => 'about',
        ));


        $this->render('page', array(
            'data' => $page_data,
        ));
    }

    public function actionContact() {
        $page_data = Pages::model()->findByAttributes(array(
            'page' => 'contact',
        ));


        $this->render('page', array(
            'data' => $page_data,
        ));
    }

    public function actionResources() {
        $page_data = Pages::model()->findByAttributes(array(
            'page' => 'resources',
        ));


        $this->render('page', array(
            'data' => $page_data,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}
