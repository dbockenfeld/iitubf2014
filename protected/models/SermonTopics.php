<?php

/**
 * This is the model class for table "sermon_topics".
 *
 * The followings are the available columns in table 'sermon_topics':
 * @property integer $id
 * @property integer $sermon_id
 * @property string $topic
 * @property integer $count
 *
 * The followings are the available model relations:
 * @property Messages $sermon
 */
class SermonTopics extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SermonTopics the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sermon_topics';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sermon_id, count', 'numerical', 'integerOnly' => true),
            array('topic', 'length', 'max' => 64),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, sermon_id, topic, count', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sermon' => array(self::BELONGS_TO, 'Messages', 'sermon_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'sermon_id' => 'Sermon',
            'topic' => 'Topic',
            'count' => 'Count',
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
        $criteria->compare('sermon_id', $this->sermon_id);
        $criteria->compare('topic', $this->topic, true);
        $criteria->compare('count', $this->count);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
