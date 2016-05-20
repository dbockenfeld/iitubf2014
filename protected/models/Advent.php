<?php

/**
 * This is the model class for table "advent".
 *
 * The followings are the available columns in table 'advent':
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $key_verse
 * @property string $key_verse_text
 * @property string $text
 * @property string $timestamp
 */
class Advent extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Advent the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'advent';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('timestamp', 'required'),
            array('title', 'length', 'max' => 255),
            array('key_verse', 'length', 'max' => 64),
            array('date, key_verse_text, text', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, date, title, key_verse, key_verse_text, text, timestamp', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'date' => 'Date',
            'title' => 'Title',
            'key_verse' => 'Key Verse',
            'key_verse_text' => 'Key Verse Text',
            'text' => 'Text',
            'timestamp' => 'Timestamp',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('key_verse', $this->key_verse, true);
        $criteria->compare('key_verse_text', $this->key_verse_text, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('timestamp', $this->timestamp, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getDate() {
        $date = $this->date;
        return $date;
    }

    public function getMonth() {
        return date('M', strtotime($this->getDate()));
    }

    public function getDay() {
        return date('j', strtotime($this->getDate()));
    }

    public function getYear() {
        return date('Y', strtotime($this->getDate()));
    }

}
