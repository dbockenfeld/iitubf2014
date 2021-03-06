<?php

/**
 * This is the model class for table "podcast_feeds".
 *
 * The followings are the available columns in table 'podcast_feeds':
 * @property integer $id
 * @property integer $series_id
 * @property string $key
 * @property string $folder
 * @property string $subtitle
 * @property string $summary
 * @property string $image
 *
 * The followings are the available model relations:
 * @property Series $series
 * @property PodcastSermons[] $podcastSermons
 */
class PodcastFeeds extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PodcastFeeds the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'podcast_feeds';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('series_id', 'numerical', 'integerOnly' => true),
            array('key', 'length', 'max' => 64),
            array('folder, image', 'length', 'max' => 256),
            array('subtitle, summary', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, series_id, key, folder, subtitle, summary, image', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'series' => array(self::BELONGS_TO, 'SermonSeries', 'series_id'),
            'podcastSermons' => array(self::HAS_MANY, 'PodcastSermons', 'feed_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'series_id' => 'Series',
            'key' => 'Key',
            'folder' => 'Folder',
            'subtitle' => 'Subtitle',
            'summary' => 'Summary',
            'image' => 'Image',
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
        $criteria->compare('series_id', $this->series_id);
        $criteria->compare('key', $this->key, true);
        $criteria->compare('folder', $this->folder, true);
        $criteria->compare('subtitle', $this->subtitle, true);
        $criteria->compare('summary', $this->summary, true);
        $criteria->compare('image', $this->image, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
