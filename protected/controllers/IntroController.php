<?php

class IntroController extends Controller {

    public $pageTitle = 'Intro | IIT UBF - University Bible Fellowship at IIT';
    public $siteDescription;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAjaxGetQuestions() {
        if (Yii::app()->request->isAjaxRequest) {
            $query = explode(" ",filter_input(INPUT_POST, "q"));
            
        }
    }

    public function init() {
        Yii::app()->clientScript->registerScriptFile("/js/intro.js")
                ->registerCSSFile("/css/intro.css");
        parent::init();
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
