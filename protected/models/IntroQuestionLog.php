<?php

/**
 * This is the model class for table "intro_question_log".
 *
 * The followings are the available columns in table 'intro_question_log':
 * @property integer $id
 * @property integer $search_log_id
 * @property integer $question_id
 * @property string $ip
 * @property string $user_agent
 * @property string $timestamp
 *
 * The followings are the available model relations:
 * @property IntroSearchLog $searchLog
 * @property IntroQuestions $question
 */
class IntroQuestionLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IntroQuestionLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'intro_question_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('timestamp', 'required'),
			array('search_log_id, question_id', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>255),
			array('user_agent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, search_log_id, question_id, ip, user_agent, timestamp', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'searchLog' => array(self::BELONGS_TO, 'IntroSearchLog', 'search_log_id'),
			'question' => array(self::BELONGS_TO, 'IntroQuestions', 'question_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'search_log_id' => 'Search Log',
			'question_id' => 'Question',
			'ip' => 'Ip',
			'user_agent' => 'User Agent',
			'timestamp' => 'Timestamp',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('search_log_id',$this->search_log_id);
		$criteria->compare('question_id',$this->question_id);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}