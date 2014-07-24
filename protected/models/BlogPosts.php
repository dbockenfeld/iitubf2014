<?php

/**
 * This is the model class for table "blog_posts".
 *
 * The followings are the available columns in table 'blog_posts':
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $summary
 * @property string $header_image
 * @property string $text
 * @property string $author
 * @property integer $active
 * @property string $posted_by
 * @property string $posted_date
 * @property string $updated_by
 * @property string $updated_date
 */
class BlogPosts extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return BlogPosts the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'blog_posts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('active', 'numerical', 'integerOnly' => true),
            array('title, header_image', 'length', 'max' => 255),
            array('author, posted_by, updated_by', 'length', 'max' => 50),
            array('date, summary, text, posted_date, updated_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, date, title, summary, header_image, text, author, active, posted_by, posted_date, updated_by, updated_date', 'safe', 'on' => 'search'),
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
            'summary' => 'Summary',
            'header_image' => 'Header Image',
            'text' => 'Text',
            'author' => 'Author',
            'active' => 'Active',
            'posted_by' => 'Posted By',
            'posted_date' => 'Posted Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
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
        $criteria->compare('summary', $this->summary, true);
        $criteria->compare('header_image', $this->header_image, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('posted_by', $this->posted_by, true);
        $criteria->compare('posted_date', $this->posted_date, true);
        $criteria->compare('updated_by', $this->updated_by, true);
        $criteria->compare('updated_date', $this->updated_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function makePostUrl() {
        $name = str_replace(' ', '-', preg_replace("/[^A-Za-z0-9 ]/", '', strtolower($this->title)));
        return '/site/blog/name/' . $name;
    }

    public function getPostMonth() {
        return date('M', strtotime($this->date));
    }

    public function getPostDay() {
        return date('j', strtotime($this->date));
    }

    public function getPostYear() {
        return date('Y', strtotime($this->date));
    }

}
