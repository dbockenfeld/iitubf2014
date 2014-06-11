<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $message_id
 * @property string $sermon_date
 * @property integer $series_id
 * @property string $title
 * @property string $passage
 * @property integer $book_id
 * @property string $verses
 * @property string $key_verse
 * @property string $key_verse_text
 * @property string $message_description
 * @property string $message_file
 * @property string $text
 * @property string $question_file
 * @property string $questions
 * @property string $message_author
 * @property string $posted_by
 * @property string $posted_date
 * @property string $updated_by
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property Books $book
 * @property Series $series
 * @property SermonFiles[] $sermonFiles
 */
class Sermons extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Sermons the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'messages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('series_id, book_id', 'numerical', 'integerOnly' => true),
            array('title, passage, message_author, posted_by, updated_by', 'length', 'max' => 50),
            array('verses, key_verse', 'length', 'max' => 64),
            array('message_file, question_file', 'length', 'max' => 100),
            array('sermon_date, key_verse_text, message_description, text, questions, posted_date, updated_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('message_id, sermon_date, series_id, title, passage, book_id, verses, key_verse, key_verse_text, message_description, message_file, text, question_file, questions, message_author, posted_by, posted_date, updated_by, updated_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'book' => array(self::BELONGS_TO, 'Books', 'book_id'),
            'series' => array(self::BELONGS_TO, 'SermonSeries', 'series_id'),
            'sermonFiles' => array(self::HAS_MANY, 'SermonFiles', 'sermon_id'),
            'sermonViewLog' => array(self::HAS_MANY, 'SermonViewLog', 'sermon_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'message_id' => 'Message',
            'sermon_date' => 'Sermon Date',
            'series_id' => 'Series',
            'title' => 'Title',
            'passage' => 'Passage',
            'book_id' => 'Book',
            'verses' => 'Verses',
            'key_verse' => 'Key Verse',
            'key_verse_text' => 'Key Verse Text',
            'message_description' => 'Message Description',
            'message_file' => 'Message File',
            'text' => 'Text',
            'question_file' => 'Question File',
            'questions' => 'Questions',
            'message_author' => 'Message Author',
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

        $criteria->compare('message_id', $this->message_id);
        $criteria->compare('sermon_date', $this->sermon_date, true);
        $criteria->compare('series_id', $this->series_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('passage', $this->passage, true);
        $criteria->compare('book_id', $this->book_id);
        $criteria->compare('verses', $this->verses, true);
        $criteria->compare('key_verse', $this->key_verse, true);
        $criteria->compare('key_verse_text', $this->key_verse_text, true);
        $criteria->compare('message_description', $this->message_description, true);
        $criteria->compare('message_file', $this->message_file, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('question_file', $this->question_file, true);
        $criteria->compare('questions', $this->questions, true);
        $criteria->compare('message_author', $this->message_author, true);
        $criteria->compare('posted_by', $this->posted_by, true);
        $criteria->compare('posted_date', $this->posted_date, true);
        $criteria->compare('updated_by', $this->updated_by, true);
        $criteria->compare('updated_date', $this->updated_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
