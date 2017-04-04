<?php

/**
 * This is the model class for table "home_event".
 *
 * The followings are the available columns in table 'home_event':
 * @property integer $id
 * @property string $background
 * @property string $foreground
 * @property string $link_text
 * @property string $link
 * @property string $body_text
 * @property string $start_date
 * @property string $end_date
 * @property integer $weight
 */
class HomeEvent extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return HomeEvent the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'home_event';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('weight', 'numerical', 'integerOnly' => true),
            array('background, foreground, link_text, link', 'length', 'max' => 255),
            array('body_text, start_date, end_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, background, foreground, link_text, link, body_text, start_date, end_date, weight', 'safe', 'on' => 'search'),
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
            'background' => 'Background',
            'foreground' => 'Foreground',
            'link_text' => 'Link Text',
            'link' => 'Link',
            'body_text' => 'Body Text',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'weight' => 'Weight',
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
        $criteria->compare('background', $this->background, true);
        $criteria->compare('foreground', $this->foreground, true);
        $criteria->compare('link_text', $this->link_text, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('body_text', $this->body_text, true);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('end_date', $this->end_date, true);
        $criteria->compare('weight', $this->weight);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
