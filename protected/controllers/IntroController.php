<?php

class IntroController extends Controller {

    public $pageTitle = 'Intro | IIT UBF - University Bible Fellowship at IIT';
    public $siteDescription;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAjaxGetQuestions() {
        if (Yii::app()->request->isAjaxRequest) {
	        $q = filter_input(INPUT_POST, "q");
            $search = array();
            if ($q != '') {
	            $query = explode(" ", $q);
	            foreach ($query as $item) {
		            $search[] = "+" . $item . "*";
	            }
            	$phrase = '"'.$q.'*"';
            } else {
	            $phrase = "";
            }
            $criteria = new CDbCriteria();
            $criteria->addCondition("MATCH (question) AGAINST('(".implode(" ", $search).") ".$phrase."' IN BOOLEAN MODE)");
            
            $result = IntroQuestions::model()->findAll($criteria);
            if ($result) {
	            $this->renderPartial("_question_list", array(
		            "list" => $result,
	            ));
            } else {
	            $this->renderPartial("_empty_list");
            }
        }
    }

    public function actionAjaxGetQuestion() {
        if (Yii::app()->request->isAjaxRequest) {
	        $qid = filter_input(INPUT_POST, "qid");
            $result = IntroQuestions::model()->findByPk($qid);
            
            $this->renderPartial("_question_input", array(
            	"question" => $result->question,
            ));
	    }
	}
	        
    public function actionAjaxGetResult() {
        if (Yii::app()->request->isAjaxRequest) {
	        $qid = filter_input(INPUT_POST, "qid");
            $result = IntroQuestions::model()->findByPk($qid);
            
            $groups = $result->introRelatedQuestions;
            $group_ids = array();
            
            foreach ($groups as $group) {
	            $group_ids[] = $group->group_id;
            }
            
            $criteria = new CDbCriteria();
            $criteria->addInCondition("group_id", $group_ids);
            $criteria->addNotInCondition("question_id", array($result->id));
//              $criteria->limit = 5;
            
            $related_questions = IntroRelatedQuestions::model()->findAll($criteria);
            
            $passages = array();
            
            foreach ($result->introPassages as $passage) {
	            $passages[$passage->region][] = $passage;
            }

	        $this->renderPartial("_question_result", array(
		        "question" => $result,
		        "related_questions" => $this->sortClosestQuestions($related_questions, $result->id),
		        "limit" => 5,
		        "passages" => $passages,
	        ));
	    }
	}
	
	protected function sortClosestQuestions($array, $val) {
		$sorted_array = array();
		$ids = array();
		
		foreach ($array as $key => $item) {
			$ids[$key] = abs($item->id - $val);
		}
		
		asort($ids);
		
		foreach ($ids as $key => $dist) {
			$sorted_array[] = $array[$key];
		}
		
		return $sorted_array;
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
