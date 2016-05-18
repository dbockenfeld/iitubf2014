<?php

/**
 * This is the model class for table "daily_bread_topics".
 *
 * The followings are the available columns in table 'daily_bread_topics':
 * @property integer $id
 * @property integer $daily_bread_id
 * @property string $topic
 * @property integer $count
 *
 * The followings are the available model relations:
 * @property DailyBreadArchive $dailyBread
 */
class DailyBreadTopics extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DailyBreadTopics the static model class
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
		return 'daily_bread_topics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('daily_bread_id, count', 'numerical', 'integerOnly'=>true),
			array('topic', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, daily_bread_id, topic, count', 'safe', 'on'=>'search'),
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
			'dailyBread' => array(self::BELONGS_TO, 'DailyBreadArchive', 'daily_bread_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'daily_bread_id' => 'Daily Bread',
			'topic' => 'Topic',
			'count' => 'Count',
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
		$criteria->compare('daily_bread_id',$this->daily_bread_id);
		$criteria->compare('topic',$this->topic,true);
		$criteria->compare('count',$this->count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}