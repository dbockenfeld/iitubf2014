<?php

/**
 * This is the model class for table "intro_passages".
 *
 * The followings are the available columns in table 'intro_passages':
 * @property integer $id
 * @property integer $question_id
 * @property integer $region
 * @property integer $book_id
 * @property string $verse
 *
 * The followings are the available model relations:
 * @property Books $book
 * @property IntroQuestions $question
 */
class IntroPassages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IntroPassages the static model class
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
		return 'intro_passages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question_id, region, book_id', 'numerical', 'integerOnly'=>true),
			array('verse', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, question_id, region, book_id, verse', 'safe', 'on'=>'search'),
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
			'book' => array(self::BELONGS_TO, 'Books', 'book_id'),
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
			'question_id' => 'Question',
			'region' => 'Region',
			'book_id' => 'Book',
			'verse' => 'Verse',
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
		$criteria->compare('question_id',$this->question_id);
		$criteria->compare('region',$this->region);
		$criteria->compare('book_id',$this->book_id);
		$criteria->compare('verse',$this->verse,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getRef() {
		return $this->book->name . " " . $this->verse;
	}
	
	public function getRefNoSpace() {
		return str_replace(" ", "&nbsp;", $this->ref);
	}
}