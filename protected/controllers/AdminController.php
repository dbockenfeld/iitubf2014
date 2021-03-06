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
                'actions' => array('create', 'update', 'index', 'logout', 'sermons', 'sermon', "changePassword", "ajaxSermonSave", "ajaxAddPassage", "ajaxRemovePassage", "ajaxAddKeyVerse", "addSermon", "ajaxChangeSeries", "ajaxDisplaySermonPassages"),
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
    
    public function actionAddSermon() {
        $sermon = new Sermons();
        $sermon->sermon_date = date("Y-m-d");
        $sermon->save();
        $this->redirect(Yii::app()->createUrl("admin/sermon", array("id" => $sermon->id)));
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
            if ($sermon->active == 0 && $_POST["Sermons"]["active"] == 1) {
                $sermon->setSermonTopics();
            }
            $sermon->active = $_POST["Sermons"]["active"];
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

            foreach ($_POST['passage'] as $passage_id => $passage) {
                $model = SermonPassages::model()->findByPk($passage_id);
                $model->book_id = $passage["book"];
                $model->passage = $passage['verses'];
                $model->save();
            }
            foreach ($_POST['verse'] as $id => $verse) {
                $model = SermonKeyVerses::model()->findByPk($id);
                $model->passage_id = $verse["passage"];
                $model->verses = $verse['verses'];
                $text = $_POST['key-verse-text'];
                $text = str_replace("<u>", "", $text);
                $text = str_replace("</u>", "", $text);
                $text = str_replace("<em>", "", $text);
                $text = str_replace("</em>", "", $text);
                $model->text = $text;
                $model->save();
            }
        }
    }

    public function actionAjaxAddPassage() {
        if (Yii::app()->request->isAjaxRequest) {
            $passage = new SermonPassages();
            $passage->sermon_id = $_POST["sermon_id"];
            $passage->save();
            $this->renderPartial("_sermon_passage_input", array(
                "passage" => $passage,
            ));
        }
    }
    
    public function actionAjaxChangeSeries() {
        if (Yii::app()->request->isAjaxRequest) {
            $series = SermonSeries::model()->findByPk($_POST['series_id']);
            $this->renderPartial("_header_image", array(
                "image" => $series->large_feature,
                "title" => $series->title,
            ));
        }
    }
    
    public function actionAjaxDisplaySermonPassages() {
        if (Yii::app()->request->isAjaxRequest) {
            $sermon = Sermons::model()->findByPk($_POST["sermon_id"]);
            $this->renderPartial("_sermon_passage", array(
                "sermon" => $sermon,
            ));
        }
    }

    public function actionAjaxAddKeyVerse() {
        if (Yii::app()->request->isAjaxRequest) {
            $verse = new SermonKeyVerses();
            $verse->sermon_id = $_POST["sermon_id"];
            $verse->save();
            $this->renderPartial("_sermon_key_verse_input", array(
                "key_verse" => $verse,
            ));
        }
    }

    public function actionAjaxRemovePassage() {
        if (Yii::app()->request->isAjaxRequest) {
            $passage = SermonPassages::model()->findByPk($_POST["sermon_id"]);
            $passage->delete();
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
    
    public function postToFacebook($sermon) {
	    require_once Yii::app()->basePath . '/extensions/facebook-php-sdk-v4/src/Facebook/autoload.php';
	    $fb = new Facebook\Facebook([
			'app_id' => '561142330727643',
			'app_secret' => '47e077d18d5d09de3993e41d4b8e8518',
			'default_graph_version' => 'v2.5',
		]);
		$linkData = [
			'link' => $sermon->makeAbsoluteSermonUrl(),
			'message' => 'Test',
		];
		
		$params = array(
		  // this is the access token for Fan Page
		  "access_token" => "CAACYHYyWcnIBAMK1y2tqiRKx8bBXGFFzjdUamOlMZCBJrTSL8ic1z5sZBarBi3DbTh9mMUz3aiZCAQRNHvOmcMxLZC53FNtkrVCq8rZCLsyjbQVZAt8o7S6Rd1UT0LK7AkgyZAlu11MC9rWND8eZBiKjjiYjwmBMLWko7k6GGPZCREehKRNFCsyM1Ll7sFb1hXycZD",
		  "message" => "Our latest message is now online.",
		  "link" => $sermon->makeAbsoluteSermonUrl(),
		  "picture" => $sermon->image,
		  "name" => $sermon->title,
		  "caption" => "iitubf.org",
		  "description" => $sermon->message_description,
		);
		try {
		  // 466400200079875 is Facebook id of Fan page https://www.facebook.com/pontikis.net
		  $ret = $fb->api('/466400200079875/feed', 'POST', $params);
		  echo 'Successfully posted to Facebook Fan Page';
		} catch(Exception $e) {
		  echo $e->getMessage();
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
