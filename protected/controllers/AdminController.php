<?php

class AdminController extends Controller {

    public $pageTitle = 'University Bible Fellowship at IIT';
    public $siteDescription;

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('login'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index', 'logout', 'sermons', 'sermon', "changePassword", "ajaxSermonSave"),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionSermons() {
        $criteria = new CDbCriteria();
        $criteria->order = "sermon_date DESC";
        $sermons = Sermons::model()->findAll($criteria);
        $this->render('sermons', array(
            'sermons' => $sermons,
        ));
    }

    public function actionSermon($id) {
        Yii::app()->clientScript->registerScriptFile('//tinymce.cachefly.net/4.2/tinymce.min.js')
                ->registerScriptFile('//code.jquery.com/ui/1.11.4/jquery-ui.min.js')
                ->registerCssFile('//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
        $page_data = new Pages();
        $sermon = Sermons::model()->findByPk($id);
//            $page_data->text = $this->formatSermon($sermon);
//            $page_data->image = $sermon->series ? str_replace('features', 'sermon', $sermon->series->large_feature) : '';
//            $download_options = $this->getStreaming($sermon) . $this->getDownloads($sermon);
//            $this->pageTitle = $sermon->title . ' (' . $sermon->getSermonPassage() . ') | Sermons | ' . $this->pageTitle;
//            $this->siteDescription = strip_tags($sermon->message_description);
        $page_data->image = $sermon->series ? str_replace('features', 'sermon', $sermon->series->large_feature) : '';
        $page_data->title = $page_data->short_title = 'Sermons';
        $this->render('sermon', array(
            'data' => $page_data,
            'image_class' => 'sermon-header',
            'sermon' => $sermon,
        ));
    }

    public function actionAjaxSermonSave() {
        if (Yii::app()->request->isAjaxRequest) {
            $sermon = Sermons::model()->findByPk($_POST['sermon_id']);
            $sermon->sermon_date = $_POST["datepicker"];
            $sermon->series_id = $_POST["Sermons"]["series_id"];
            $sermon->title = $_POST['title'];
            $sermon->message_author = $_POST["author"];
            $sermon->message_description = $_POST["summary-text"];
            $body_text = $_POST["body-text"];
            $body_text = str_replace("<p>&nbsp;</p>", "", $body_text);
            $body_text = str_replace("<p></p>", "", $body_text);
            $body_text = str_replace("<u>", "", $body_text);
            $body_text = str_replace("</u>", "", $body_text);
            $body_text = str_replace("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", "", $body_text);
            $sermon->text = $body_text;
            $sermon->save();
        }
    }

    public function actionChangePassword() {
        if (isset($_POST["current"])) {
            $user = AdminUsers::model()->findByPk(Yii::app()->user->id);
            if ($_POST["current"] != '') {
                if (CPasswordHelper::verifyPassword($_POST["current"], $user->password)) {
                    if ($_POST['new'] == $_POST["verify_new"]) {
                        if (strlen($_POST["new"]) >= 8) {
                            $user->password = CPasswordHelper::hashPassword($_POST["new"]);
                            $user->reset = 0;
                            $user->save();
                            Yii::app()->user->setFlash('success', "Your password has been updated");
                        } else {
                            Yii::app()->user->setFlash('error', "Your new password must be at least 8 characters long");
                        }
                    } else {
                        Yii::app()->user->setFlash('error', "Your new password does not match");
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Your current password is incorrect");
                }
            } else {
                Yii::app()->user->setFlash('error', "Your current password is blank");
            }
        }

        $this->render("changePassword");
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
                $user = AdminUsers::model()->findByPk(Yii::app()->user->id);
            if ($user->reset == 1) {
                $this->redirect("changePassword");
            }
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
        $this->redirect('/admin');
    }

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function init() {
        Yii::app()->clientScript->registerCSSFile("/css/admin.css");
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
