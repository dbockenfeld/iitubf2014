<?php

/**
 * This is the model class for table "podcast_sermons".
 *
 * The followings are the available columns in table 'podcast_sermons':
 * @property string $id
 * @property integer $feed_id
 * @property integer $sermon_id
 * @property string $file_location
 * @property string $duration
 * @property string $length
 * @property string $file_type
 *
 * The followings are the available model relations:
 * @property PodcastFeeds $feed
 * @property Messages $sermon
 */
class PodcastSermons extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PodcastSermons the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'podcast_sermons';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('feed_id, sermon_id', 'numerical', 'integerOnly' => true),
            array('file_location', 'length', 'max' => 128),
            array('duration', 'length', 'max' => 8),
            array('length', 'length', 'max' => 32),
            array('file_type', 'length', 'max' => 16),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, feed_id, sermon_id, file_location, duration, length, file_type', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'feed' => array(self::BELONGS_TO, 'PodcastFeeds', 'feed_id'),
            'sermon' => array(self::BELONGS_TO, 'Sermons', 'sermon_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'feed_id' => 'Feed',
            'sermon_id' => 'Sermon',
            'file_location' => 'File Location',
            'duration' => 'Duration',
            'length' => 'Length',
            'file_type' => 'File Type',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('feed_id', $this->feed_id);
        $criteria->compare('sermon_id', $this->sermon_id);
        $criteria->compare('file_location', $this->file_location, true);
        $criteria->compare('duration', $this->duration, true);
        $criteria->compare('length', $this->length, true);
        $criteria->compare('file_type', $this->file_type, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
