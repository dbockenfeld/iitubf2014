<?php

/**
 * This is the model class for table "daily_bread_archive".
 *
 * The followings are the available columns in table 'daily_bread_archive':
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $passage
 * @property string $key_verse
 * @property string $text
 * @property string $prayer
 * @property string $one_word
 * @property string $intro_title
 * @property string $intro_text
 * @property string $timestamp
 */
class DailyBreadArchive extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DailyBreadArchive the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'daily_bread_archive';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('timestamp', 'required'),
            array('title, prayer, one_word, intro_title', 'length', 'max' => 255),
            array('passage, key_verse', 'length', 'max' => 64),
            array('date, text, intro_text', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, date, title, passage, key_verse, text, prayer, one_word, intro_title, intro_text, timestamp', 'safe', 'on' => 'search'),
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
            'passage' => 'Passage',
            'key_verse' => 'Key Verse',
            'text' => 'Text',
            'prayer' => 'Prayer',
            'one_word' => 'One Word',
            'intro_title' => 'Intro Title',
            'intro_text' => 'Intro Text',
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
        $criteria->compare('passage', $this->passage, true);
        $criteria->compare('key_verse', $this->key_verse, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('prayer', $this->prayer, true);
        $criteria->compare('one_word', $this->one_word, true);
        $criteria->compare('intro_title', $this->intro_title, true);
        $criteria->compare('intro_text', $this->intro_text, true);
        $criteria->compare('timestamp', $this->timestamp, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
