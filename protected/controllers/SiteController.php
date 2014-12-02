<?php

class SiteController extends Controller {

    public $pageTitle = 'IIT UBF - University Bible Fellowship at IIT';
    public $siteDescription;
    public $rssTitle;
    public $rssSubTitle;
    public $rssImage;
    public $rssSummary;

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
        $page_data = Pages::model()->findByAttributes(array(
            'page' => 'index',
        ));

        $this->siteDescription = $page_data->text;

        $this->render('index');
    }

    public function actionDailyBread() {
        $db_date = Yii::app()->request->getParam('year') . '-' . Yii::app()->request->getParam('month') . '-' . Yii::app()->request->getParam('day');
        $today = date('Y-m-d');
        $params = date('/Y/m/d');

        if (strlen($db_date) < 3) {
            $this->redirect(array('dailybread' . $params));
        }
        $page_data = Pages::model()->findByAttributes(array(
            'page' => 'daily-bread',
        ));

        $this->pageTitle = $page_data->title . ' | ' . $this->pageTitle;

        uploadDBtoDB::archive();

        $criteria = new CDbCriteria();
        $criteria->compare('date', $db_date);

        $model = DailyBreadArchive::model()->find($criteria);

        if ($model->key_verse != '') {
            $token = "iax7j0J2ZRgWCdcQfg0fGa0Qa0Ttsq1LNkdajJGX";

            $verse = str_replace(' ', '+', $model->key_verse);

            $url = "https://bibles.org/v2/passages.xml?q[]=$verse&version=eng-ESV";

            // Set up cURL
            $ch = curl_init();
// Set the URL
            curl_setopt($ch, CURLOPT_URL, $url);
// don't verify SSL certificate
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// Return the contents of the response as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// Follow redirects
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// Set up authentication
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, "$token:X");

// Do the request
            $response = curl_exec($ch);
            curl_close($ch);

// Parse the XML into a SimpleXML object
            $xml = new SimpleXMLElement($response);

// Print the text from the 0th verse
//        print ($xml->verses->verse[0]->text);
            $regex = "#<h3(.*?)</h3>#";
            $regex2 = "#<sup(.*?)</sup>#";
            $tmp = preg_replace($regex, '', $xml->search->result->passages->passage[0]->text);
            $model->key_verse_text = preg_replace($regex2, '', $tmp);
        } else {
            $model->key_verse_text = '';
        }

        $page_data->text = $this->formatDailyBread($model);

//        $xmlstr = simplexml_load_file('http://ubf.org/dbrss.php');
//
//        $page_data->text = str_replace('</h3></p></b>', '</h3>', str_replace('<b><p align="center"><h3>', '<h3>', $xmlstr->channel->item->description));

        $this->render('page', array(
            'data' => $page_data,
        ));
    }

    protected function formatDailyBread($model) {
        return $this->renderPartial('_daily_bread_text', array(
                    'model' => $model,
                        ), true);
    }

    public function actionAdvent() {
        $db_date = Yii::app()->request->getParam('year') . '-' . Yii::app()->request->getParam('month') . '-' . Yii::app()->request->getParam('day');
        $today = date('Y-m-d');
        $params = date('/Y/m/d');

        if (strlen($db_date) < 3) {
            $this->redirect(array('advent' . $params));
        }
        $page_data = Pages::model()->findByAttributes(array(
            'page' => 'advent',
        ));

        $this->pageTitle = $page_data->title . ' | ' . $this->pageTitle;


        $criteria = new CDbCriteria();
        $criteria->compare('date', $db_date);

        if (!$model = Advent::model()->find($criteria)) {
            $criteria = new CDbCriteria();
            $criteria->order = 'date DESC';
            $model = Advent::model()->find($criteria);
            $params = date('/Y/m/d', strtotime($model->date));
            $this->redirect(array('advent' . $params));
        }

        $page_data->text = $this->formatAdvent($model);

        $this->render('page', array(
            'data' => $page_data,
            'image_class' => 'sermon-header',  
        ));
    }

    protected function formatAdvent($model) {
        return $this->renderPartial('_advent_text', array(
                    'model' => $model,
                        ), true);
    }

    public function actionSermons() {
        $sermon_name = Yii::app()->request->getParam('name');
        $sermon_date = Yii::app()->request->getParam('year') . '-' . Yii::app()->request->getParam('month') . '-' . Yii::app()->request->getParam('day');
        if ($sermon_name) {
            $page_data = new Pages();
            $sermon = $this->getSermon($sermon_name, $sermon_date);
            $page_data->text = $this->formatSermon($sermon);
            $page_data->image = $sermon->series ? str_replace('features', 'sermon', $sermon->series->large_feature) : '';
            $download_options = $this->getStreaming($sermon) . $this->getDownloads($sermon);
            $this->pageTitle = $sermon->title . ' (' . $sermon->getSermonPassage() . ') | Sermons | ' . $this->pageTitle;
            $this->siteDescription = strip_tags($sermon->message_description);
        } else {
            $page_data = Pages::model()->findByAttributes(array(
                'page' => 'sermon-listing',
            ));
            $page_data->text = $this->getSermonList();
            $download_options = '';
            $this->pageTitle = $page_data->title . ' | ' . $this->pageTitle;
        }

        $page_data->title = $page_data->short_title = 'Sermons';

        $this->render('page', array(
            'data' => $page_data,
            'image_class' => 'sermon-header',
            'sidebar_top' => $download_options,
        ));
    }

//    public function actionSermonRedirect() {
//        $sermons = Sermons::model()->findAll();
//        $this->render('generator', array('sermons'=>$sermons));
//    }

    protected function getSermon($name, $date) {
        $criteria = new CDbCriteria();
        $criteria->addCondition('title SOUNDS LIKE "' . $name . '"');
        $criteria->compare('sermon_date', $date);

        $sermon = Sermons::model()->find($criteria);
//        $sermon->text = $name;
        return $sermon;
    }

    protected function getSermonList() {
        $criteria = new CDbCriteria();
        $criteria->compare('active', 1);
        $criteria->order = 'message_id DESC';

        $sermons = Sermons::model()->findAll($criteria);
        return $this->renderPartial('_sermon_list', array(
                    'sermons' => $sermons,
                        ), true);
    }

    protected function formatSermon($sermon) {
        return $this->renderPartial('_sermon_text', array(
                    'sermon' => $sermon,
                        ), true);
    }

    protected function getDownloads($sermon) {
        $criteria = new CDbCriteria();
        $download_urls = array();
        $download_urls[] = array(
            'type' => 'transcript',
            'url' => $sermon->getTranscript()
        );
        if ($sermon->hasQuestions()) {
            $question_url = $sermon->getQuestions();
            $download_urls[] = array(
                'type' => 'questions',
                'url' => $question_url
            );
        }
        if ($sermon->hasSermonFiles()) {
            $file_info = $sermon->getSermonFiles();
            foreach ($file_info as $item) {
                $download_urls[] = array(
                    'type' => $item['type'],
                    'url' => $item['url'],
                );
            }
        }
        return $this->formatDownloads($download_urls);
    }

    protected function getStreaming($sermon) {
        if ($sermon->hasSermonAudio()) {
            return $this->renderPartial('_streaming_audio', array(
                        'audio' => $sermon->getSermonAudio(),
                        'id' => $sermon->message_id,
                            ), true);
        }
        return false;
    }

    protected function formatDownloads($downloads) {
        return $this->renderPartial('_sermon_downloads', array(
                    'downloads' => $downloads,
                        ), true);
    }

    public function actionGenerateSermonTranscript($id) {
        $sermon = Sermons::model()->findByPk($id);
        if (!preg_match('/bot|Disqus|spider|crawler|curl|Ezooms|^$/i', $_SERVER['HTTP_USER_AGENT'])) {
            $log = new DownloadLog();
            $log->sermon_id = $id;
            $log->type = 'text';
            $log->ip = $_SERVER['REMOTE_ADDR'];
            $log->system = $_SERVER['HTTP_USER_AGENT'];
            $log->save(false);
        }
        $this->render('download_transcript', array(
            'sermon' => $sermon,
        ));
    }

    public function actionGenerateSermonQuestions($id) {
        $sermon = Sermons::model()->findByPk($id);
        if (!preg_match('/bot|Disqus|spider|crawler|curl|Ezooms|^$/i', $_SERVER['HTTP_USER_AGENT'])) {
            $log = new DownloadLog();
            $log->sermon_id = $id;
            $log->type = 'questions';
            $log->ip = $_SERVER['REMOTE_ADDR'];
            $log->system = $_SERVER['HTTP_USER_AGENT'];
            $log->save(false);
        }
        $this->render('download_questions', array(
            'sermon' => $sermon,
        ));
    }

    public function getSermonSeriesFilterList() {
        $criteria = new CDbCriteria();
        $criteria->order = 'title';

        $models = SermonSeries::model()->findAll($criteria);

        return $this->renderPartial('_sermon_series_filter_list', array(
                    'models' => $models,
                        ), TRUE);
    }

    public function getBookFilterList() {
        $criteria = new CDbCriteria();
        $criteria->order = 'id';

        $models = Books::model()->findAll($criteria);

        return $this->renderPartial('_book_filter_list', array(
                    'models' => $models,
                        ), TRUE);
    }

    public function actionSermonFeeds() {
        $feed_name = Yii::app()->request->getParam('name');
        $this->layout = 'rss';
        $criteria = new CDbCriteria();
        $criteria->compare('t.key', $feed_name);

        $model = PodcastFeeds::model()->find($criteria);

        $this->rssTitle = $model->series->title;
        $this->rssSubTitle = $model->subtitle;
        $this->rssSummary = $model->summary;
        $this->rssImage = $model->image;

//        print_r(htmlspecialchars($model->series->title));
//        Yii::app()->end();

        $this->render('rss_feed', array(
            'feed' => $model,
        ));
    }

    public function actionAjaxAddBlogViewLog() {
        if (Yii::app()->request->isAjaxRequest) {
            if (!preg_match('/bot|Disqus|spider|crawler|curl|Ezooms|^$/i', $_SERVER['HTTP_USER_AGENT'])) {
                $log = new BlogViewLog();
                $log->post_id = $_POST['id'];
                $log->ip = $_SERVER['REMOTE_ADDR'];
                $log->system = $_SERVER['HTTP_USER_AGENT'];
                $log->save(false);
            }
        }
    }

    public function actionAjaxAddViewLog() {
        if (Yii::app()->request->isAjaxRequest) {
            if (!preg_match('/bot|Disqus|spider|crawler|curl|Ezooms|^$/i', $_SERVER['HTTP_USER_AGENT'])) {
                $log = new SermonViewLog();
                $log->sermon_id = $_POST['id'];
                $log->ip = $_SERVER['REMOTE_ADDR'];
                $log->system = $_SERVER['HTTP_USER_AGENT'];
                $log->save(false);
            }
        }
    }

    public function actionAjaxAddStreamLog() {
        if (Yii::app()->request->isAjaxRequest) {
            if (!preg_match('/bot|Disqus|spider|crawler|curl|Ezooms|^$/i', $_SERVER['HTTP_USER_AGENT'])) {
                $log = new SermonStreamLog();
                $log->sermon_id = $_POST['id'];
                $log->ip = $_SERVER['REMOTE_ADDR'];
                $log->system = $_SERVER['HTTP_USER_AGENT'];
                $log->save(false);
            }
        }
    }

    public function actionDownloadSermonFile($id) {
        $file = SermonFiles::model()->findByPk($id);
        if (!preg_match('/bot|Disqus|spider|crawler|curl|Ezooms|^$/i', $_SERVER['HTTP_USER_AGENT'])) {
            $log = new DownloadLog();
            $log->sermon_id = $file->sermon_id;
            $log->type = 'file';
            $log->ip = $_SERVER['REMOTE_ADDR'];
            $log->system = $_SERVER['HTTP_USER_AGENT'];
            $log->save(false);
        }
        $this->render('download_file', array(
            'file' => $file,
        ));
    }

    public function actionBlog() {
        $post_name = Yii::app()->request->getParam('name');
        $post_date = Yii::app()->request->getParam('year') . '-' . Yii::app()->request->getParam('month') . '-' . Yii::app()->request->getParam('day');
        if ($post_name) {
            $page_data = new Pages();
            $post = $this->getPost($post_name, $post_date);
            $page_data->text = $this->formatPost($post);
            $page_data->image = $post->header_image;
            $page_data->title = $page_data->short_title = 'Blog';
            $this->pageTitle = $post->title . ' | ' . $page_data->title . ' | ' . $this->pageTitle;
        } else {
            $page_data = Pages::model()->findByAttributes(array(
                'page' => 'blog',
            ));
            $this->pageTitle = $page_data->title . ' | ' . $this->pageTitle;
            $page_data->text = $this->getPostList();
        }


        $this->render('page', array(
            'data' => $page_data,
            'image_class' => 'sermon-header',
        ));
    }

    protected function getPost($name, $date) {
        $criteria = new CDbCriteria();
        $criteria->addCondition('title SOUNDS LIKE "' . $name . '"');
        $criteria->compare('date', $date);

        $post = BlogPosts::model()->find($criteria);
//        $sermon->text = $name;
        return $post;
    }

    protected function formatPost($post) {
        return $this->renderPartial('_post_text', array(
                    'post' => $post,
                        ), true);
    }

    protected function getPostList() {
        $criteria = new CDbCriteria();
        $criteria->compare('active', 1);
        $criteria->order = 'date DESC';

        $posts = BlogPosts::model()->findAll($criteria);
        return $this->renderPartial('_post_list', array(
                    'posts' => $posts,
                        ), true);
    }

    public function actionAbout() {
        $page_data = Pages::model()->findByAttributes(array(
            'page' => 'about',
        ));

        $this->pageTitle = $page_data->title . ' | ' . $this->pageTitle;

        $this->render('page', array(
            'data' => $page_data,
        ));
    }

    public function actionContact() {
        $page_data = Pages::model()->findByAttributes(array(
            'page' => 'contact',
        ));

        $this->pageTitle = $page_data->title . ' | ' . $this->pageTitle;

        $this->render('page', array(
            'data' => $page_data,
        ));
    }

    public function actionResources() {
        $page_data = Pages::model()->findByAttributes(array(
            'page' => 'resources',
        ));

        $this->pageTitle = $page_data->title . ' | ' . $this->pageTitle;

        $this->render('page', array(
            'data' => $page_data,
        ));
    }
    
    public function actionWorship() {
        $page_data = Pages::model()->findByAttributes(array(
            'page' => 'worship',
        ));

        $this->pageTitle = $page_data->title . ' | ' . $this->pageTitle;

        $this->render('page', array(
            'data' => $page_data,
            'image_class' => 'sermon-header',  
            ));
        
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->pageTitle = 'Error | ' . $this->pageTitle;

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
