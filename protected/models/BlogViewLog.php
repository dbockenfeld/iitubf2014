<?php

/**
 * This is the model class for table "blog_view_log".
 *
 * The followings are the available columns in table 'blog_view_log':
 * @property string $id
 * @property integer $post_id
 * @property string $ip
 * @property string $system
 * @property string $timestamp
 */
class BlogViewLog extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return BlogViewLog the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'blog_view_log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('timestamp', 'required'),
            array('post_id', 'numerical', 'integerOnly' => true),
            array('ip', 'length', 'max' => 45),
            array('system', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, post_id, ip, system, timestamp', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'posts' => array(self::BELONGS_TO, 'BlogPosts', 'post_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'post_id' => 'Post',
            'ip' => 'Ip',
            'system' => 'System',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('post_id', $this->post_id);
        $criteria->compare('ip', $this->ip, true);
        $criteria->compare('system', $this->system, true);
        $criteria->compare('timestamp', $this->timestamp, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
