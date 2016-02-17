<?php

/**
 * This is the model class for table "series".
 *
 * The followings are the available columns in table 'series':
 * @property integer $id
 * @property string $title
 * @property string $short_title
 * @property integer $book_id
 * @property string $large_feature
 * @property string $medium_feature
 * @property string $small_feature
 * @property string $thumbnail
 *
 * The followings are the available model relations:
 * @property Messages[] $messages
 * @property PodcastFeeds[] $podcastFeeds
 * @property Books $book
 */
class Series extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Series the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'series';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('book_id', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 128),
            array('short_title, large_feature, medium_feature, small_feature, thumbnail', 'length', 'max' => 64),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, short_title, book_id, large_feature, medium_feature, small_feature, thumbnail', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'messages' => array(self::HAS_MANY, 'Messages', 'series_id'),
            'podcastFeeds' => array(self::HAS_MANY, 'PodcastFeeds', 'series_id'),
            'book' => array(self::BELONGS_TO, 'Books', 'book_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'short_title' => 'Short Title',
            'book_id' => 'Book',
            'large_feature' => 'Large Feature',
            'medium_feature' => 'Medium Feature',
            'small_feature' => 'Small Feature',
            'thumbnail' => 'Thumbnail',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('short_title', $this->short_title, true);
        $criteria->compare('book_id', $this->book_id);
        $criteria->compare('large_feature', $this->large_feature, true);
        $criteria->compare('medium_feature', $this->medium_feature, true);
        $criteria->compare('small_feature', $this->small_feature, true);
        $criteria->compare('thumbnail', $this->thumbnail, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public static function getSeriesList() {
        $criteria = new CDbCriteria();
        $criteria->order = "title ASC";
        $model = self::model()->findAll($criteria);
        return CHtml::listData($model, "id", "title");
    }

}
